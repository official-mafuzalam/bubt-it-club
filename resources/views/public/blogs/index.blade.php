<x-app-layout>
    <x-slot name="main">
        <!-- Hero Section -->
        <header class="pt-24 pb-12 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold leading-tight mb-4">Our Blog</h1>
                <p class="text-xl mb-8">Latest news, tutorials, and insights from our team</p>
            </div>
        </header>

        <!-- Blog Content -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Featured Post -->
                {{-- @if ($featuredPost)
                    <div class="mb-16">
                        <h2 class="text-2xl font-bold text-gray-900 mb-8">Featured Post</h2>
                        <div
                            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300 border border-gray-100">
                            <div class="md:flex">
                                @if ($featuredPost->featured_image)
                                    <div class="md:w-1/3">
                                        <img src="{{ asset('storage/' . $featuredPost->featured_image) }}"
                                            alt="{{ $featuredPost->title }}" class="w-full h-full object-cover">
                                    </div>
                                @endif
                                <div class="p-6 md:w-2/3">
                                    <div class="flex items-center text-sm text-gray-500 mb-2">
                                        <span>{{ $featuredPost->created_at->format('F j, Y') }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $featuredPost->reading_time }} min read</span>
                                    </div>
                                    <h3 class="text-xl font-semibold mb-2">{{ $featuredPost->title }}</h3>
                                    <p class="text-gray-600 mb-4">{{ $featuredPost->excerpt }}</p>
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @foreach ($featuredPost->categories as $category)
                                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <a href="{{ route('public.blog.show', $featuredPost->slug) }}"
                                        class="text-blue-600 font-medium hover:text-blue-800 inline-flex items-center">
                                        Read More
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif --}}

                <!-- Recent Posts -->
                <div class="mb-16">
                    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-900">Latest Posts</h2>
                        <div class="mt-4 md:mt-0">
                            <select id="category-filter"
                                class="px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @if ($posts->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-gray-500">No blog posts available yet. Please check back later.</p>
                        </div>
                    @else
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($posts as $post)
                                <div
                                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300 border border-gray-100">
                                    @if ($post->featured_image)
                                        <img src="{{ asset('storage/' . $post->featured_image) }}"
                                            alt="{{ $post->title }}" class="w-full h-48 object-cover">
                                    @endif
                                    <div class="p-6">
                                        <div class="flex items-center text-sm text-gray-500 mb-2">
                                            <span>{{ $post->created_at->format('F j, Y') }}</span>
                                            <span class="mx-2">•</span>
                                            <span>{{ $post->reading_time }} min read</span>
                                        </div>
                                        <h3 class="text-xl font-semibold mb-2">{{ $post->title }}</h3>
                                        <p class="text-gray-600 mb-4">{{ Str::limit($post->excerpt, 100) }}</p>
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            @foreach ($post->categories as $category)
                                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">
                                                    {{ $category->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                        <a href="{{ route('public.blogs.show', $post->slug) }}"
                                            class="text-blue-600 font-medium hover:text-blue-800 inline-flex items-center">
                                            Read More
                                            <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-12">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>

                <!-- Popular Categories -->
                <div class="pt-8 border-t border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8">Browse by Category</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach ($categories as $category)
                            <a href="{{ route('public.blogs.index', ['category' => $category->slug]) }}"
                                class="bg-gray-50 hover:bg-gray-100 p-4 rounded-lg text-center transition duration-300">
                                <h3 class="font-medium text-gray-900">{{ $category->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $category->posts_count }} posts</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        @push('scripts')
            <script>
                // Category filter functionality
                document.getElementById('category-filter').addEventListener('change', function() {
                    const category = this.value;
                    window.location.href = "{{ route('public.blogs.index') }}" + (category ? `?category=${category}` : '');
                });
            </script>
        @endpush
    </x-slot>
</x-app-layout>
