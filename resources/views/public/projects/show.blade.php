<x-app-layout>
    <x-slot name="main">
        <!-- Project Hero Section -->
        <header class="pt-24 pb-16 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
                    <div class="md:w-2/3">
                        <h1 class="text-3xl md:text-4xl font-bold leading-tight mb-4">{{ $project->title }}</h1>
                        <p class="text-xl mb-6">{{ $project->short_description }}</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach (json_decode($project->technologies) ?? [] as $tech)
                                <span class="px-3 py-1 rounded-full bg-blue-700 text-white text-sm">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-6 md:mt-0 flex space-x-4">
                        @if ($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank"
                                class="inline-flex items-center px-4 py-2 bg-white text-blue-600 rounded-md hover:bg-gray-100">
                                <i class="fab fa-github mr-2"></i> GitHub
                            </a>
                        @endif
                        @if ($project->demo_url)
                            <a href="{{ $project->demo_url }}" target="_blank"
                                class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                <i class="fas fa-external-link-alt mr-2"></i> Live Demo
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- Project Details -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-3 gap-12">
                    <!-- Main Content -->
                    <div class="md:col-span-2">
                        @if ($project->image_url)
                            <img src="{{ asset('storage/' . $project->image_url) }}" alt="{{ $project->title }}"
                                class="w-full rounded-lg shadow-md mb-8">
                        @endif

                        <div class="prose max-w-none">
                            {!! Str::markdown($project->description) !!}
                        </div>

                        <!-- Project Gallery -->
                        @if ($project->gallery_images)
                            <div class="mt-12">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6">Project Gallery</h2>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    @foreach (json_decode($project->gallery_images) as $image)
                                        <a href="{{ asset('storage/' . $image) }}" data-lightbox="project-gallery">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Project gallery image"
                                                class="w-full h-32 object-cover rounded-md hover:opacity-90 transition">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar -->
                    <div class="md:col-span-1">
                        <div class="bg-gray-50 rounded-lg p-6 sticky top-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Project Details</h3>

                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Project Status</h4>
                                    <p class="mt-1 text-sm text-gray-900">
                                        @if ($project->end_date && $project->end_date->isPast())
                                            <span class="px-2 py-1 rounded-full bg-gray-100 text-gray-800 text-xs">
                                                Completed
                                            </span>
                                        @else
                                            <span class="px-2 py-1 rounded-full bg-green-100 text-green-800 text-xs">
                                                In Progress
                                            </span>
                                        @endif
                                    </p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Project Duration</h4>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ $project->start_date->format('M Y') }} -
                                        {{ $project->end_date ? $project->end_date->format('M Y') : 'Present' }}
                                    </p>
                                </div>

                                @if ($project->team_members)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Team Members</h4>
                                        <div class="mt-2 space-y-2">
                                            @foreach (json_decode($project->team_members) as $member)
                                                <div class="flex items-center">
                                                    <div
                                                        class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                                        <span
                                                            class="text-gray-600 text-xs">{{ Str::initials($member->name) }}</span>
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-sm font-medium text-gray-900">
                                                            {{ $member->name }}</p>
                                                        <p class="text-xs text-gray-500">{{ $member->role }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Technologies Used</h4>
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        @foreach (json_decode($project->technologies) ?? [] as $tech)
                                            <span class="px-2 py-1 rounded-full bg-gray-100 text-gray-800 text-xs">
                                                {{ $tech }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                @if ($project->github_url || $project->demo_url)
                                    <div class="pt-4 border-t border-gray-200">
                                        <h4 class="text-sm font-medium text-gray-500">Project Links</h4>
                                        <div class="mt-2 space-y-2">
                                            @if ($project->github_url)
                                                <a href="{{ $project->github_url }}" target="_blank"
                                                    class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                                                    <i class="fab fa-github mr-2"></i> GitHub Repository
                                                </a>
                                            @endif
                                            @if ($project->demo_url)
                                                <a href="{{ $project->demo_url }}" target="_blank"
                                                    class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-external-link-alt mr-2"></i> Live Demo
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Projects -->
                {{-- @if ($relatedProjects->isNotEmpty())
                    <div class="mt-16 pt-12 border-t border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Projects</h2>
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($relatedProjects as $project)
                                <div
                                    class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition border border-gray-100">
                                    <a href="{{ route('public.projects.show', $project->slug) }}">
                                        @if ($project->image_url)
                                            <img src="{{ asset('storage/' . $project->image_url) }}"
                                                alt="{{ $project->title }}" class="w-full h-40 object-cover">
                                        @endif
                                        <div class="p-4">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $project->title }}
                                            </h3>
                                            <p class="text-gray-600 text-sm">
                                                {{ Str::limit($project->short_description, 60) }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif --}}
            </div>
        </section>

        @push('scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
        @endpush
    </x-slot>
</x-app-layout>
