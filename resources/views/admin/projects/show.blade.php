<x-admin-layout>
    <x-slot name="main">
        @section('page-title')
            <title>Project Details | Admin Panel</title>
        @endsection

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Project Details
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    View and manage project information
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.projects.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-150">
                    Back to Projects
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Project Image -->
                    <div class="md:col-span-1">
                        @if ($project->image_url)
                            <img src="{{ asset('storage/' . $project->image_url) }}" alt="{{ $project->title }}"
                                class="w-full h-auto rounded-lg shadow-md">
                        @else
                            <div class="flex items-center justify-center h-48 bg-gray-100 rounded-lg dark:bg-gray-700">
                                <span class="text-gray-400 dark:text-gray-500">No image available</span>
                            </div>
                        @endif
                    </div>

                    <!-- Project Details -->
                    <div class="md:col-span-2 space-y-4">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ $project->title }}</h2>
                            <div class="flex items-center mt-2 space-x-2">
                                <span
                                    class="px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $project->is_published ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }}">
                                    {{ $project->is_published ? 'Published' : 'Draft' }}
                                </span>
                                @if ($project->trashed())
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                        Deleted
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div>
                            <p class="text-gray-600 dark:text-gray-300">{{ $project->short_description }}</p>
                        </div>

                        <div class="prose max-w-none dark:prose-invert">
                            {!! Str::markdown($project->description) !!}
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Project Dates</h3>
                                <p class="text-gray-900 dark:text-white">
                                    {{ $project->start_date->format('M Y') }} -
                                    {{ $project->end_date ? $project->end_date->format('M Y') : 'Present' }}
                                </p>
                            </div>

                            <div>
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Technologies Used</h3>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    @foreach (json_decode($project->technologies, true) ?? [] as $tech)
                                        <span
                                            class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                            {{ $tech }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if ($project->github_url)
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">GitHub Repository
                                    </h3>
                                    <a href="{{ $project->github_url }}" target="_blank"
                                        class="text-blue-600 hover:underline dark:text-blue-400">
                                        {{ parse_url($project->github_url, PHP_URL_HOST) }}
                                    </a>
                                </div>
                            @endif

                            @if ($project->demo_url)
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Live Demo</h3>
                                    <a href="{{ $project->demo_url }}" target="_blank"
                                        class="text-blue-600 hover:underline dark:text-blue-400">
                                        {{ parse_url($project->demo_url, PHP_URL_HOST) }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
                    @if ($project->trashed())
                        <form action="{{ route('admin.projects.restore', $project->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-150">
                                Restore Project
                            </button>
                        </form>
                        <form action="{{ route('admin.projects.forceDelete', $project->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Are you sure you want to permanently delete this project?')"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-150">
                                Delete Permanently
                            </button>
                        </form>
                    @else
                        <a href="{{ route('admin.projects.edit', $project->id) }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-150">
                            Edit Project
                        </a>
                        <form action="{{ route('admin.projects.togglePublish', $project->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 {{ $project->is_published ? 'bg-yellow-600 hover:bg-yellow-700 focus:ring-yellow-500' : 'bg-green-600 hover:bg-green-700 focus:ring-green-500' }} border border-transparent rounded-md font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors duration-150">
                                {{ $project->is_published ? 'Unpublish' : 'Publish' }}
                            </button>
                        </form>
                        <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Are you sure you want to move this project to trash?')"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-150">
                                Move to Trash
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </x-slot>
</x-admin-layout>