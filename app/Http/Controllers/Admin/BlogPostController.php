<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:blog')->only(['index', 'show']);
        $this->middleware('can:blog_create')->only(['create', 'store']);
        $this->middleware('can:blog_edit')->only(['edit', 'update', 'togglePublish']);
        $this->middleware('can:blog_delete')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = BlogPost::with(['author', 'categories'])
            ->withTrashed()
            ->latest()
            ->get();

        return view('admin.blog.posts.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::all();
        $authors = Member::active()->get();

        return view('admin.blog.posts.create', compact('categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'required|string|max:255',
            'author_id' => 'required|exists:members,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'categories' => 'required|array',
            'categories.*' => 'exists:blog_categories,id',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blog/posts', 'public');
        }

        // Generate slug
        $validated['slug'] = Str::slug($validated['title']);

        // Create the post
        $post = BlogPost::create($validated);

        // Attach categories
        $post->categories()->sync($request->categories);

        // Handle publishing
        if ($request->is_published && !$post->published_at) {
            $post->update(['published_at' => now()]);
        }

        return redirect()->route('admin.blog.posts.index')
            ->with('success', 'Blog post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogPost $blog)
    {
        $blog->load(['author', 'categories', 'comments']);

        return view('admin.blog.posts.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blog)
    {
        $categories = BlogCategory::all();
        $authors = Member::active()->get();
        $selectedCategories = $blog->categories->pluck('id')->toArray();

        return view('admin.blog.posts.edit', compact('blog', 'categories', 'authors', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'required|string|max:255',
            'author_id' => 'required|exists:members,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:blog_categories,id',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blog/posts', 'public');
        }

        // Generate slug if title changed
        if ($blog->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Update the blog
        $blog->update($validated);

        // Sync categories
        $blog->categories()->sync($request->categories);

        // Handle publishing
        if ($request->is_published && !$blog->published_at) {
            $blog->update(['published_at' => now()]);
        } elseif (!$request->is_published && $blog->published_at) {
            $blog->update(['published_at' => null]);
        }

        return redirect()->route('admin.blog.posts.index')
            ->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blog)
    {
        $blog->delete();

        return redirect()->route('admin.blog.posts.index')
            ->with('success', 'Blog post moved to trash.');
    }

    /**
     * Restore the specified resource from trash.
     */
    public function restore($id)
    {
        $blog = BlogPost::withTrashed()->findOrFail($id);
        $blog->restore();

        return redirect()->route('admin.blog.posts.index')
            ->with('success', 'Blog post restored successfully.');
    }

    /**
     * Permanently delete the specified resource.
     */
    public function forceDelete($id)
    {
        $blog = BlogPost::withTrashed()->findOrFail($id);

        // Delete featured image if exists
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->forceDelete();

        return redirect()->route('admin.blog.posts.index')
            ->with('success', 'Blog post permanently deleted.');
    }

    /**
     * Toggle publish status
     */
    public function togglePublish(BlogPost $blog)
    {
        if ($blog->is_published) {
            $blog->update(['is_published' => false, 'published_at' => null]);
            $message = 'Blog post unpublished successfully.';
        } else {
            $blog->update(['is_published' => true, 'published_at' => now()]);
            $message = 'Blog post published successfully.';
        }

        return redirect()->back()->with('success', $message);
    }
}