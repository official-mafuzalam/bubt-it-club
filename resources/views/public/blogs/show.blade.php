<x-app-layout>
    <x-slot name="main">
        <!-- Post Header -->
        <header class="pt-24 pb-12 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="flex flex-wrap justify-center gap-2 mb-4">
                        @foreach ($post->categories as $category)
                            <span class="px-3 py-1 rounded-full bg-blue-700 text-white text-sm">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold leading-tight mb-4">{{ $post->title }}</h1>
                    <div
                        class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-6 text-sm">
                        <div class="flex items-center">
                            @if ($post->author->photo_url)
                                <img class="h-8 w-8 rounded-full mr-2"
                                    src="{{ asset('storage/' . $post->author->photo_url) }}"
                                    alt="{{ $post->author->name }}">
                            @else
                                <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center mr-2">
                                    <span class="text-gray-600 text-xs">{{ Str::initials($post->author->name) }}</span>
                                </div>
                            @endif
                            <span>{{ $post->author->name }}</span>
                        </div>
                        <span class="hidden sm:block">•</span>
                        <span>{{ $post->created_at->format('F j, Y') }}</span>
                        <span class="hidden sm:block">•</span>
                        <span>{{ $post->reading_time }} min read</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Post Content -->
        <article class="py-16 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                @if ($post->featured_image)
                    <div class="mb-12">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                            class="w-full rounded-lg shadow-md">
                    </div>
                @endif

                <div class="prose max-w-none dark:prose-invert mx-auto">
                    {!! Str::markdown($post->content) !!}
                </div>

                <!-- Author Bio -->
                <div class="mt-16 pt-12 border-t border-gray-200">
                    <div class="flex flex-col md:flex-row items-center">
                        @if ($post->author->photo_url)
                            <img class="h-20 w-20 rounded-full mr-6 mb-4 md:mb-0"
                                src="{{ asset('storage/' . $post->author->photo_url) }}"
                                alt="{{ $post->author->name }}">
                        @else
                            <div
                                class="h-20 w-20 rounded-full bg-gray-200 flex items-center justify-center mr-6 mb-4 md:mb-0">
                                <span class="text-gray-600 text-xl">{{ Str::initials($post->author->name) }}</span>
                            </div>
                        @endif
                        <div>
                            <a href="{{ route('public.members.show', $post->author->id) }}" class="text-lg font-semibold text-gray-900">{{ $post->author->name }}</a>
                            @if ($post->author->position)
                                <p class="text-gray-600 mb-2">{{ $post->author->position }}</p>
                            @endif
                            @if ($post->author->bio)
                                <p class="text-gray-700">{{ $post->author->bio }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Add this section after the author bio section in your show.blade.php -->
                <div class="mt-16 pt-12 border-t border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8">Comments ({{ $post->comments->count() }})</h2>

                    <h4 class="text-lg font-semibold text-red-500 mb-4">Only IT Club members can comment.</h4>
                    <!-- Comment Form -->
                    @auth
                        <div class="mb-8">
                            <form action="{{ route('public.blogs.comments.store', $post->slug) }}" method="POST">
                                @csrf
                                <div>
                                    <label for="member_id" class="block text-sm font-medium text-gray-700 mb-1">Student ID
                                        *</label>
                                    <input type="number" name="member_id" id="member_id"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                    @error('member_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name
                                        *</label>
                                    <input type="text" name="name" id="name"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">IT Club Member Email
                                        *</label>
                                    <input type="email" name="email" id="email"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Add your
                                        comment *</label>
                                    <textarea name="content" id="content" rows="3" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                    @error('content')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Post Comment
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="mb-8 p-4 bg-blue-50 rounded-md">
                            <p class="text-blue-800">Please <a href="{{ route('login') }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium">login</a> to post a comment.</p>
                        </div>
                    @endauth

                    <!-- Comments List -->
                    @if ($post->comments->isEmpty())
                        <p class="text-gray-500">No comments yet. Be the first to comment!</p>
                    @else
                        <div class="space-y-6">
                            @foreach ($post->comments as $comment)
                                <div class="flex">
                                    <div class="flex-shrink-0 mr-4">
                                        @if ($comment->member && $comment->member->photo_url)
                                            <img class="h-10 w-10 rounded-full"
                                                src="{{ asset('storage/' . $comment->member->photo_url) }}"
                                                alt="{{ $comment->member->name }}">
                                        @else
                                            <div
                                                class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                <span class="text-gray-600 text-sm">
                                                    {{ $comment->member ? Str::initials($comment->member->name) : Str::initials($comment->name) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="flex items-center justify-between">
                                                <h4 class="font-medium text-gray-900">
                                                    {{ $comment->member ? $comment->member->name : $comment->name }}
                                                </h4>
                                                <span class="text-sm text-gray-500">
                                                    {{ $comment->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                            <div class="mt-2 text-gray-700">
                                                {{ $comment->content }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Related Posts -->
                @if ($relatedPosts->isNotEmpty())
                    <div class="mt-16 pt-12 border-t border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-900 mb-8">You Might Also Like</h2>
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($relatedPosts as $related)
                                <div
                                    class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition border border-gray-100">
                                    <a href="{{ route('public.blog.show', $related->slug) }}">
                                        @if ($related->featured_image)
                                            <img src="{{ asset('storage/' . $related->featured_image) }}"
                                                alt="{{ $related->title }}" class="w-full h-40 object-cover">
                                        @endif
                                        <div class="p-4">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $related->title }}
                                            </h3>
                                            <p class="text-gray-600 text-sm">{{ Str::limit($related->excerpt, 60) }}
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </article>
    </x-slot>
</x-app-layout>
