<x-admin-layout>
    <x-slot name="main">
        @section('page-title')
            <title>Gallery Details | Admin Panel</title>
        @endsection

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Gallery Details
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    View and manage gallery images
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
            <div class="p-6">
                <!-- Gallery Header -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $gallery->title }}</h2>
                    @if($gallery->description)
                        <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $gallery->description }}</p>
                    @endif
                    <div class="flex items-center space-x-4">
                        <span class="px-2 py-1 rounded-full 
                            {{ $gallery->is_published ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }}">
                            {{ $gallery->is_published ? 'Published' : 'Draft' }}
                        </span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $gallery->images->count() }} images
                        </span>
                        @if($gallery->trashed())
                            <span class="px-2 py-1 rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                Deleted
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Gallery Images -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="gallery-images">
                    @foreach($gallery->images as $image)
                        <div class="relative group" data-image-id="{{ $image->id }}">
                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                 alt="{{ $image->caption }}" 
                                 class="w-full h-48 object-cover rounded-lg">
                            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                <div class="text-center">
                                    @if($image->caption)
                                        <p class="text-white text-sm mb-2">{{ $image->caption }}</p>
                                    @endif
                                    <form action="{{ route('admin.galleries.deleteImage', $image->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-400 hover:text-red-300"
                                                onclick="return confirm('Are you sure you want to delete this image?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($gallery->images->isEmpty())
                    <div class="text-center py-12">
                        <p class="text-gray-500 dark:text-gray-400">No images in this gallery yet.</p>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
                    <a href="{{ route('admin.galleries.edit', $gallery->id) }}"
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-150">
                        Edit Gallery
                    </a>
                    <form action="{{ route('admin.galleries.togglePublish', $gallery->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 {{ $gallery->is_published ? 'bg-yellow-600 hover:bg-yellow-700 focus:ring-yellow-500' : 'bg-green-600 hover:bg-green-700 focus:ring-green-500' }} border border-transparent rounded-md font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors duration-150">
                            {{ $gallery->is_published ? 'Unpublish' : 'Publish' }}
                        </button>
                    </form>
                    <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-150"
                                onclick="return confirm('Are you sure you want to move this gallery to trash?')">
                            Move to Trash
                        </button>
                    </form>
                </div>
            </div>
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
            </script>
        @endpush
    </x-slot>
</x-admin-layout>