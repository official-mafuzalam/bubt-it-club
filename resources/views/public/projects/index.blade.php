<x-app-layout>
    <x-slot name="main">
        <!-- Hero Section -->
        <header class="pt-24 pb-12 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold leading-tight mb-4">Our Projects</h1>
                <p class="text-xl mb-8">Explore the innovative projects created by our talented members</p>
            </div>
        </header>

        <!-- Projects Content -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Projects Grid -->
                <div class="mb-16">
                    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-900">Featured Projects</h2>
                        <div class="mt-4 md:mt-0">
                            <select id="category-filter"
                                class="px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                <option value="">All Categories</option>
                                <option value="web">Web Development</option>
                                <option value="mobile">Mobile Apps</option>
                                <option value="ai">AI/ML</option>
                                <option value="iot">IoT</option>
                                <option value="design">UI/UX Design</option>
                            </select>
                        </div>
                    </div>

                    @if ($projects->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-gray-500">No projects available at the moment. Please check back later.</p>
                        </div>
                    @else
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($projects as $project)
                                <div
                                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300 border border-gray-100">
                                    <div class="relative">
                                        @if ($project->image_url)
                                            <img src="{{ asset('storage/' . $project->image_url) }}"
                                                alt="{{ $project->title }}" class="w-full h-48 object-cover">
                                        @else
                                            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                                                alt="Default project image" class="w-full h-48 object-cover">
                                        @endif
                                        <div
                                            class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                            {{ $project->category ?? 'Project' }}
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <div class="flex items-center text-sm text-gray-500 mb-2">
                                            <i class="far fa-calendar-alt mr-2"></i>
                                            <span>{{ $project->start_date->format('M Y') }} -
                                                {{ $project->end_date ? $project->end_date->format('M Y') : 'Present' }}
                                            </span>
                                        </div>
                                        <h3 class="text-xl font-semibold mb-2">{{ $project->title }}</h3>
                                        <p class="text-gray-600 mb-4">{{ Str::limit($project->short_description, 100) }}
                                        </p>
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            @foreach (json_decode($project->technologies) ?? [] as $tech)
                                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">
                                                    {{ $tech }}
                                                </span>
                                            @endforeach
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <a href="{{ route('public.projects.show', $project->slug) }}"
                                                class="text-blue-600 font-medium hover:text-blue-800 inline-flex items-center">
                                                View Project
                                                <i class="fas fa-arrow-right ml-2"></i>
                                            </a>
                                            @if ($project->github_url)
                                                <a href="{{ $project->github_url }}" target="_blank"
                                                    class="text-gray-600 hover:text-gray-800">
                                                    <i class="fab fa-github text-lg"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-12">
                            {{ $projects->links() }}
                        </div>
                    @endif
                </div>

                <!-- Featured Projects -->
                {{-- @if ($featuredProjects->isNotEmpty())
                    <div class="pt-8 border-t border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-900 mb-8">Highlighted Projects</h2>

                        <div class="grid md:grid-cols-2 gap-8">
                            @foreach ($featuredProjects as $project)
                                <div
                                    class="bg-gradient-to-r from-blue-50 to-gray-50 p-6 rounded-lg border border-blue-100">
                                    <div class="flex items-start">
                                        @if ($project->image_url)
                                            <img src="{{ asset('storage/' . $project->image_url) }}"
                                                alt="{{ $project->title }}"
                                                class="w-20 h-20 object-cover rounded-md mr-4">
                                        @endif
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $project->title }}
                                            </h3>
                                            <p class="text-gray-600 text-sm mb-3">
                                                {{ Str::limit($project->short_description, 80) }}</p>
                                            <a href="{{ route('public.projects.show', $project->slug) }}"
                                                class="text-blue-600 hover:text-blue-800 font-medium text-sm inline-flex items-center">
                                                Learn more
                                                <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif --}}
            </div>
        </section>

        @push('scripts')
            <script>
                // Category filter functionality
                document.getElementById('category-filter').addEventListener('change', function() {
                    const category = this.value;
                    window.location.href = "{{ route('public.projects') }}" + (category ? `?category=${category}` : '');
                });
            </script>
        @endpush
    </x-slot>
</x-app-layout>
