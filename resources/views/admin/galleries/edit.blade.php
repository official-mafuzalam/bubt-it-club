<x-admin-layout>
    <x-slot name="main">
        @section('page-title')
            <title>Edit Gallery | Admin Panel</title>
        @endsection

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Edit Gallery
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Update gallery information and manage images
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.galleries.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-150">
                    Back to Galleries
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800">
            <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Gallery Info -->
                        <div class="space-y-4">
                            <div>
                                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Title <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="title" id="title" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ old('title', $gallery->title) }}">
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Description
                                </label>
                                <textarea name="description" id="description" rows="4"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ old('description', $gallery->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Gallery Settings -->
                        <div class="space-y-4">
                            <div>
                                <label for="images" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Add More Images
                                </label>
                                <input type="file" name="images[]" id="images" multiple
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    accept="image/*">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    Select additional images (JPEG, PNG, JPG, GIF)
                                </p>
                                @error('images')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="published_at" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Publish Date
                                    </label>
                                    <input type="datetime-local" name="published_at" id="published_at"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        value="{{ old('published_at', $gallery->published_at ? $gallery->published_at->format('Y-m-d\TH:i') : '') }}">
                                    @error('published_at')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" name="is_published" id="is_published" value="1"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                        {{ old('is_published', $gallery->is_published) ? 'checked' : '' }}>
                                    <label for="is_published"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        Publish gallery
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Existing Images -->
                    @if($gallery->images->isNotEmpty())
                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Current Images</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="gallery-images">
                            @foreach($gallery->images as $image)
                                <div class="relative group" data-image-id="{{ $image->id }}">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                                         alt="{{ $image->caption }}" 
                                         class="w-full h-32 object-cover rounded-lg">
                                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                        <div class="text-center">
                                            @if($image->caption)
                                                <p class="text-white text-xs mb-1">{{ $image->caption }}</p>
                                            @endif
                                            <form action="{{ route('admin.galleries.deleteImage', $image->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-400 hover:text-red-300 text-xs"
                                                        onclick="return confirm('Are you sure you want to delete this image?')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Form Footer -->
                <div class="flex items-center justify-end p-6 bg-gray-50 dark:bg-gray-700 space-x-3">
                    <button type="reset"
                        class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800">
                        Reset
                    </button>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Update Gallery
                    </button>
                </div>
            </form>
        </div>

        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
            <script>
                // Make images sortable
                new Sortable(document.getElementById('gallery-images'), {
                    animation: 150,
                    onEnd: function(evt) {
                        const imageOrder = Array.from(document.querySelectorAll('#gallery-images > div'))
                            .map(div => div.dataset.imageId);
                        
                        fetch("{{ route('admin.galleries.updateImageOrder', $gallery->id) }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ order: imageOrder })
                        });
                    }
                });

                // Initialize datetime picker
                flatpickr("#published_at", {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                });
            </script>
        @endpush
    </x-slot>
</x-admin-layout>