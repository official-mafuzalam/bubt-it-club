<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::withTrashed()->latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technologies = [
            'HTML',
            'CSS',
            'JavaScript',
            'PHP',
            'Laravel',
            'Vue.js',
            'React',
            'Angular',
            'Node.js',
            'Python',
            'Django',
            'MySQL',
            'PostgreSQL',
            'MongoDB',
            'Tailwind CSS',
            'Bootstrap',
            'Git',
            'Docker',
            'AWS',
            'Firebase'
        ];

        return view('admin.projects.create', compact('technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'github_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
            'technologies' => 'nullable|array',
            'technologies.*' => 'string',
            'is_published' => 'boolean',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image_url'] = $request->file('image')->store('projects', 'public');
        }

        // Generate slug
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(6);

        // Convert technologies to JSON
        $validated['technologies'] = $request->technologies ? json_encode($request->technologies) : null;

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $technologies = [
            'HTML',
            'CSS',
            'JavaScript',
            'PHP',
            'Laravel',
            'Vue.js',
            'React',
            'Angular',
            'Node.js',
            'Python',
            'Django',
            'MySQL',
            'PostgreSQL',
            'MongoDB',
            'Tailwind CSS',
            'Bootstrap',
            'Git',
            'Docker',
            'AWS',
            'Firebase'
        ];

        return view('admin.projects.edit', compact('project', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::withTrashed()->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'github_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
            'technologies' => 'nullable|array',
            'technologies.*' => 'string',
            'is_published' => 'boolean',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($project->image_url) {
                Storage::disk('public')->delete($project->image_url);
            }
            $validated['image_url'] = $request->file('image')->store('projects', 'public');
        }

        // Generate slug if title changed
        if ($project->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Convert technologies to JSON
        $validated['technologies'] = $request->technologies ? json_encode($request->technologies) : null;

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project moved to trash.');
    }

    /**
     * Restore the specified resource from trash.
     */
    public function restore(string $id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->route('admin.projects.index')->with('success', 'Project restored successfully.');
    }

    /**
     * Permanently delete the specified resource.
     */
    public function forceDelete(string $id)
    {
        $project = Project::withTrashed()->findOrFail($id);

        // Delete image if exists
        if ($project->image_url) {
            Storage::disk('public')->delete($project->image_url);
        }

        $project->forceDelete();

        return redirect()->route('admin.projects.index')->with('success', 'Project permanently deleted.');
    }

    /**
     * Toggle publish status
     */
    public function togglePublish(string $id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->update(['is_published' => !$project->is_published]);

        $status = $project->is_published ? 'published' : 'unpublished';
        return redirect()->back()->with('success', "Project $status successfully.");
    }
}