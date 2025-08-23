<x-app-layout>
    <x-slot name="main">
        <!-- Hero Section -->
        {{-- <header class="pt-24 pb-12 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold leading-tight mb-4">{{ $gallery->title }}</h1>
                <p class="text-xl mb-8">{{ $gallery->description }}</p>
            </div>
        </header> --}}

        <!-- About Content -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="container mx-auto px-4 py-8">
                    <!-- Breadcrumb -->
                    <nav class="flex mb-6" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="{{ route('public.welcome') }}" class="text-gray-700 hover:text-blue-600">Home</a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <span class="mx-2 text-gray-400">/</span>
                                    <a href="{{ route('public.galleries.index') }}"
                                        class="text-gray-700 hover:text-blue-600">Galleries</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <span class="mx-2 text-gray-400">/</span>
                                    <span class="text-gray-500">{{ Str::limit($gallery->title, 30) }}</span>
                                </div>
                            </li>
                        </ol>
                    </nav>

                    <!-- Gallery Header -->
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $gallery->title }}</h1>

                        @if ($gallery->description)
                            <p class="text-gray-600 text-lg mb-4">{{ $gallery->description }}</p>
                        @endif

                        <div class="flex items-center text-sm text-gray-500">
                            <span class="mr-4">{{ $images->count() }} photos</span>
                            <span>{{ $gallery->published_at->format('F j, Y') }}</span>
                        </div>
                    </div>

                    <!-- Gallery Images -->
                    @if ($images->count())
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-12">
                            @foreach ($images as $image)
                                <div class="group relative bg-white rounded-lg shadow-md overflow-hidden">
                                    <img src="{{ Storage::url($image->image_path) }}"
                                        alt="{{ $image->title ?? $gallery->title }}"
                                        class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300 cursor-pointer"
                                        onclick="openLightbox({{ $loop->index }})">

                                    @if ($image->title || $image->description)
                                        <div
                                            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-end p-4">
                                            <div
                                                class="text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                @if ($image->title)
                                                    <h3 class="font-semibold">{{ $image->title }}</h3>
                                                @endif
                                                @if ($image->description)
                                                    <p class="text-sm">{{ Str::limit($image->description, 60) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-6xl mb-4">🖼️</div>
                            <h2 class="text-2xl text-gray-600 mb-4">No photos in this gallery yet</h2>
                        </div>
                    @endif

                    <!-- Related Galleries -->
                    @if ($relatedGalleries->count())
                        <div class="mt-12">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">Related Galleries</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                @foreach ($relatedGalleries as $related)
                                    <a href="{{ route('galleries.show', $related) }}" class="block group">
                                        <div
                                            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                                            @if ($related->images->count())
                                                <img src="{{ Storage::url($related->images->first()->image_path) }}"
                                                    alt="{{ $related->title }}"
                                                    class="w-full h-32 object-cover group-hover:scale-105 transition-transform duration-300">
                                            @else
                                                <div class="w-full h-32 bg-gray-200 flex items-center justify-center">
                                                    <span class="text-gray-500">No images</span>
                                                </div>
                                            @endif
                                            <div class="p-3">
                                                <h3 class="font-semibold text-gray-800 group-hover:text-blue-600">
                                                    {{ Str::limit($related->title, 30) }}
                                                </h3>
                                                <p class="text-sm text-gray-500">{{ $related->images->count() }} photos
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Lightbox Modal -->
                <div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 hidden z-50">
                    <div class="relative w-full h-full flex items-center justify-center">
                        <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-3xl z-10">
                            &times;
                        </button>

                        <button onclick="prevImage()" class="absolute left-4 text-white text-3xl z-10">
                            ‹
                        </button>

                        <button onclick="nextImage()" class="absolute right-4 text-white text-3xl z-10">
                            ›
                        </button>

                        <div class="max-w-4xl max-h-full p-4">
                            <img id="lightbox-image" src="" alt=""
                                class="max-w-full max-h-full object-contain">

                            <div id="lightbox-caption" class="text-white text-center mt-4">
                                <h3 id="lightbox-title" class="text-xl font-semibold"></h3>
                                <p id="lightbox-description" class="text-gray-300"></p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- @push('scripts')
                    <script>
                        let currentIndex = 0;
                        const images = @json(
                            $images->map(fn($img) => [
                                    'src' => Storage::url($img->image_path),
                                    'title' => $img->title,
                                    'description' => $img->description,
                                ]));

                        function openLightbox(index) {
                            currentIndex = index;
                            updateLightbox();
                            document.getElementById('lightbox').classList.remove('hidden');
                            document.body.style.overflow = 'hidden';
                        }

                        function closeLightbox() {
                            document.getElementById('lightbox').classList.add('hidden');
                            document.body.style.overflow = 'auto';
                        }

                        function prevImage() {
                            currentIndex = (currentIndex - 1 + images.length) % images.length;
                            updateLightbox();
                        }

                        function nextImage() {
                            currentIndex = (currentIndex + 1) % images.length;
                            updateLightbox();
                        }

                        function updateLightbox() {
                            const image = images[currentIndex];
                            document.getElementById('lightbox-image').src = image.src;
                            document.getElementById('lightbox-title').textContent = image.title || '';
                            document.getElementById('lightbox-description').textContent = image.description || '';
                        }

                        // Keyboard navigation
                        document.addEventListener('keydown', (e) => {
                            if (!document.getElementById('lightbox').classList.contains('hidden')) {
                                if (e.key === 'Escape') closeLightbox();
                                if (e.key === 'ArrowLeft') prevImage();
                                if (e.key === 'ArrowRight') nextImage();
                            }
                        });
                    </script>
                @endpush --}}

                <style>
                    .line-clamp-2 {
                        display: -webkit-box;
                        -webkit-line-clamp: 2;
                        -webkit-box-orient: vertical;
                        overflow: hidden;
                    }
                </style>
            </div>
        </section>
    </x-slot>
</x-app-layout>
