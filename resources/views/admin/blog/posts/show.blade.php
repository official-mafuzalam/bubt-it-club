<x-admin-layout>
    <x-slot name="main">
        @section('page-title')
            <title>Blog Post Details | Admin Panel</title>
        @endsection

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Blog Post Details
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    View and manage post information
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.blog.posts.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-150">
                    Back to Posts
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800">
            <div class="p-6">
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Main Content -->
                    <div class="md:col-span-2">
                        <!-- Post Header -->
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $post->title }}</h2>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-4">
                                <span class="mr-4">
                                    <i class="fas fa-user mr-1"></i>
                                    {{ $post->author->name }}
                                </span>
                                <span class="mr-4">
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    {{ $post->created_at->format('M j, Y') }}
                                </span>
                                <span>
                                    <i class="far fa-clock mr-1"></i>
                                    {{ $post->reading_time }} min read
                                </span>
                            </div>

                            @if ($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                    class="w-full rounded-lg shadow-md mb-4">
                            @endif

                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach ($post->categories as $category)
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>

                            <div class="flex items-center space-x-4 mb-4">
                                <span
                                    class="px-2 py-1 rounded-full 
                                    {{ $post->is_published ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }}">
                                    {{ $post->is_published ? 'Published' : 'Draft' }}
                                </span>
                                @if ($post->trashed())
                                    <span
                                        class="px-2 py-1 rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                        Deleted
                                    </span>
                                @endif
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-eye mr-1"></i>
                                    {{ $post->views }} views
                                </span>
                            </div>
                        </div>

                        <!-- Post Content -->
                        <div class="prose max-w-none dark:prose-invert mb-8">
                            {!! Str::markdown($post->content) !!}
                        </div>

                        <!-- Comments Section -->
                        <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Comments
                                ({{ $post->comments->count() }})</h3>

                            @if ($post->comments->isEmpty())
                                <p class="text-gray-500 dark:text-gray-400">No comments yet.</p>
                            @else
                                <div class="space-y-6">
                                    @foreach ($post->comments as $comment)
                                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0">
                                                    @if ($comment->member)
                                                        <img class="h-10 w-10 rounded-full"
                                                            src="{{ $comment->member->photo_url ? asset('storage/' . $comment->member->photo_url) : 'https://ui-avatars.com/api/?name=' . urlencode($comment->member->name) }}"
                                                            alt="{{ $comment->member->name }}">
                                                    @else
                                                        <div
                                                            class="h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                                            <i class="fas fa-user text-gray-500 dark:text-gray-300"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ml-3">
                                                    <div class="flex items-center">
                                                        <h4 class="text-sm font-medium text-gray-900 dark:text-white">
                                                            {{ $comment->member ? $comment->member->name : $comment->name }}
                                                        </h4>
                                                        <span class="ml-2 text-xs text-gray-500 dark:text-gray-400">
                                                            {{ $comment->created_at->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                    <div class="mt-1 text-sm text-gray-700 dark:text-gray-300">
                                                        {{ $comment->content }}
                                                    </div>
                                                    <div class="mt-2 flex space-x-4">
                                                        <button
                                                            class="text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                            Reply
                                                        </button>
                                                        <form
                                                            action="{{ route('admin.blog.comments.toggleApprove', $comment->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit"
                                                                class="text-xs {{ $comment->is_approved ? 'text-yellow-600 hover:text-yellow-800 dark:text-yellow-400 dark:hover:text-yellow-300' : 'text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300' }}">
                                                                {{ $comment->is_approved ? 'Unapprove' : 'Approve' }}
                                                            </button>
                                                        </form>
                                                        <form
                                                            action="{{ route('admin.blog.comments.destroy', $comment->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-xs text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300"
                                                                onclick="return confirm('Are you sure you want to delete this comment?')">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="md:col-span-1">
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 sticky top-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Post Details</h3>

                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Author</h4>
                                    <div class="mt-2 flex items-center">
                                        @if ($post->author->photo_url)
                                            <img class="h-8 w-8 rounded-full"
                                                src="{{ asset('storage/' . $post->author->photo_url) }}"
                                                alt="{{ $post->author->name }}">
                                        @else
                                            <div
                                                class="h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                                <span class="text-xs text-gray-600 dark:text-gray-300">
                                                    {{ Str::initials($post->author->name) }}
                                                </span>
                                            </div>
                                        @endif
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $post->author->name }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $post->author->position ?? 'Member' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Publication Status
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                        @if ($post->is_published)
                                            <span
                                                class="px-2 py-1 rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 text-xs">
                                                Published
                                            </span>
                                            @if ($post->published_at)
                                                <span class="block mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $post->published_at->format('M j, Y \a\t g:i A') }}
                                                </span>
                                            @endif
                                        @else
                                            <span
                                                class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 text-xs">
                                                Draft
                                            </span>
                                        @endif
                                    </p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</h4>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                        {{ $post->created_at->format('M j, Y \a\t g:i A') }}
                                    </p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</h4>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                        {{ $post->updated_at->format('M j, Y \a\t g:i A') }}
                                    </p>
                                </div>

                                <div class="pt-4 border-t border-gray-200 dark:border-gray-600">
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Actions</h4>
                                    <div class="space-y-2">
                                        <a href="{{ route('admin.blog.posts.edit', $post->id) }}"
                                            class="block w-full text-center px-3 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
                                            Edit Post
                                        </a>
                                        <form action="{{ route('admin.blog.posts.togglePublish', $post->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="w-full px-3 py-2 {{ $post->is_published ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} text-white text-sm rounded-md">
                                                {{ $post->is_published ? 'Unpublish' : 'Publish' }}
                                            </button>
                                        </form>
                                        @if ($post->trashed())
                                            <form action="{{ route('admin.blog.posts.restore', $post->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="w-full px-3 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                                                    Restore
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.blog.posts.forceDelete', $post->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-full px-3 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700"
                                                    onclick="return confirm('Are you sure you want to permanently delete this post?')">
                                                    Delete Permanently
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.blog.posts.destroy', $post->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-full px-3 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700"
                                                    onclick="return confirm('Are you sure you want to move this post to trash?')">
                                                    Move to Trash
                                                </button>
                                            </form>
                                        @endif
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
