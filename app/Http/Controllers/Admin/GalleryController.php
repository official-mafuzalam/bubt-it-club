<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:gallery')->only(['index', 'show']);
        $this->middleware('can:gallery_create')->only(['create', 'store']);
        $this->middleware('can:gallery_edit')->only(['edit', 'update', 'togglePublish']);
        $this->middleware('can:gallery_delete')->only(['destroy', 'restore', 'forceDelete']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::with('images')
            ->withTrashed()
            ->latest()
            ->get();

        return view('admin.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'captions' => 'nullable|array',
            'captions.*' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        // Create gallery
        $gallery = Gallery::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'],
            'is_published' => $validated['is_published'] ?? false,
            'published_at' => $validated['published_at'] ?? null,
        ]);

        // Upload images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $imagePath = $image->store('galleries', 'public');

                GalleryImage::create([
                    'gallery_id' => $gallery->id,
                    'image_path' => $imagePath,
                    'caption' => $validated['captions'][$index] ?? null,
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        $gallery->load('images');
        return view('admin.galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        $gallery->load('images');
        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'captions' => 'nullable|array',
            'captions.*' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        // Update gallery
        $gallery->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'description' => $validated['description'],
            'is_published' => $validated['is_published'] ?? false,
            'published_at' => $validated['published_at'] ?? null,
        ]);

        // Handle new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $imagePath = $image->store('galleries', 'public');

                GalleryImage::create([
                    'gallery_id' => $gallery->id,
                    'image_path' => $imagePath,
                    'caption' => $validated['captions'][$index] ?? null,
                    'order' => $gallery->images()->count() + $index,
                ]);
            }
        }

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery moved to trash.');
    }

    /**
     * Restore the specified resource from trash.
     */
    public function restore($id)
    {
        $gallery = Gallery::withTrashed()->findOrFail($id);
        $gallery->restore();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery restored successfully.');
    }

    /**
     * Permanently delete the specified resource.
     */
    public function forceDelete($id)
    {
        $gallery = Gallery::withTrashed()->findOrFail($id);

        // Delete all images
        foreach ($gallery->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        $gallery->forceDelete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery permanently deleted.');
    }

    /**
     * Delete a specific image from gallery
     */
    public function deleteImage(GalleryImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return redirect()->back()
            ->with('success', 'Image deleted successfully.');
    }

    /**
     * Toggle publish status
     */
    public function togglePublish(Gallery $gallery)
    {
        $gallery->update([
            'is_published' => !$gallery->is_published,
            'published_at' => $gallery->is_published ? null : now()
        ]);

        $status = $gallery->is_published ? 'published' : 'unpublished';
        return redirect()->back()->with('success', "Gallery {$status} successfully.");
    }

    /**
     * Update image order
     */
    public function updateImageOrder(Request $request, Gallery $gallery)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:gallery_images,id'
        ]);

        foreach ($request->order as $index => $imageId) {
            GalleryImage::where('id', $imageId)
                ->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}