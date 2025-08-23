<x-app-layout>
    <x-slot name="main">
        <!-- Hero Section -->
        <header class="pt-24 pb-12 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold leading-tight mb-4">Galleries BUBT IT Club</h1>
                <p class="text-xl mb-8">
                    Explore the vibrant and diverse galleries showcasing the activities and events of the BUBT IT Club.
                </p>
            </div>
        </header>

        <!-- About Content -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="container mx-auto px-4 py-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-8">Photo Galleries</h1>

                    @if ($galleries->count())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @foreach ($galleries as $gallery)
                                <div
                                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                                    <a href="{{ route('public.galleries.show', $gallery) }}">
                                        @if ($gallery->images->count())
                                            <img src="{{ Storage::url($gallery->images->first()->image_path) }}"
                                                alt="{{ $gallery->title }}" class="w-full h-48 object-cover">
                                        @else
                                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                                <span class="text-gray-500">No images</span>
                                            </div>
                                        @endif
                                    </a>

                                    <div class="p-4">
                                        <h2 class="text-xl font-semibold text-gray-800 mb-2">
                                            <a href="{{ route('public.galleries.show', $gallery) }}"
                                                class="hover:text-blue-600">
                                                {{ $gallery->title }}
                                            </a>
                                        </h2>

                                        @if ($gallery->description)
                                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                                {{ Str::limit($gallery->description, 100) }}
                                            </p>
                                        @endif

                                        <div class="flex justify-between items-center text-sm text-gray-500">
                                            <span>{{ $gallery->images->count() }} photos</span>
                                            <span>{{ $gallery->published_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-8">
                            {{ $galleries->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-6xl mb-4">📷</div>
                            <h2 class="text-2xl text-gray-600 mb-4">No galleries available yet</h2>
                            <p class="text-gray-500">Check back later for new photo galleries.</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>
