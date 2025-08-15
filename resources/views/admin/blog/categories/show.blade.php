<x-admin-layout>
    <x-slot name="main">
        @section('page-title')
            <title>Category Details | Admin Panel</title>
        @endsection

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Category Details
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    View and manage category information
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.blog.categories.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-150">
                    Back to Categories
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800">
            <div class="p-6">
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Main Content -->
                    <div class="md:col-span-2">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $category->name }}</h2>
                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-4">
                            <span class="mr-4">
                                <i class="fas fa-link mr-1"></i>
                                {{ $category->slug }}
                            </span>
                            <span>
                                <i class="fas fa-file-alt mr-1"></i>
                                {{ $category->posts_count }} posts
                            </span>
                        </div>

                        @if ($category->description)
                            <div class="prose max-w-none dark:prose-invert mb-6">
                                {{ $category->description }}
                            </div>
                        @endif

                        <!-- Recent Posts -->
                        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Recent Posts</h3>

                            @if ($category->posts->isEmpty())
                                <p class="text-gray-500 dark:text-gray-400">No posts in this category yet.</p>
                            @else
                                <div class="space-y-4">
                                    @foreach ($category->posts->take(5) as $post)
                                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                            <h4 class="text-md font-semibold text-gray-900 dark:text-white">
                                                <a href="{{ route('admin.blog.posts.show', $post->id) }}"
                                                    class="hover:text-blue-600 dark:hover:text-blue-400">
                                                    {{ $post->title }}
                                                </a>
                                            </h4>
                                            <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                {{ $post->created_at->format('M j, Y') }} •
                                                {{ $post->author->name }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                @if ($category->posts->count() > 5)
                                    <div class="mt-4 text-right">
                                        <a href="{{ route('admin.blog.posts.index', ['category' => $category->id]) }}"
                                            class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm">
                                            View all posts →
                                        </a>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="md:col-span-1">
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 sticky top-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Category Details</h3>

                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</h4>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                        {{ $category->created_at->format('M j, Y \a\t g:i A') }}
                                    </p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</h4>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                        {{ $category->updated_at->format('M j, Y \a\t g:i A') }}
                                    </p>
                                </div>

                                <div class="pt-4 border-t border-gray-200 dark:border-gray-600">
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Actions</h4>
                                    <div class="space-y-2">
                                        <a href="{{ route('admin.blog.categories.edit', $category->id) }}"
                                            class="block w-full text-center px-3 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
                                            Edit Category
                                        </a>
                                        <form action="{{ route('admin.blog.categories.destroy', $category->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full px-3 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700"
                                                onclick="return confirm('Are you sure you want to delete this category?')">
                                                Delete Category
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-admin-layout>