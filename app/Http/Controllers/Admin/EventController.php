<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of events.
     */
    public function index(Request $request)
    {
        $events = Event::query()
            ->when($request->filled('date_from'), function ($query) use ($request) {
                $query->where('start_date', '>=', $request->date_from);
            })
            ->when($request->filled('date_to'), function ($query) use ($request) {
                $query->where('start_date', '<=', $request->date_to);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                if ($request->status === 'upcoming') {
                    $query->where('start_date', '>', now());
                } elseif ($request->status === 'ongoing') {
                    $query->where('start_date', '<=', now())
                        ->where('end_date', '>=', now());
                } elseif ($request->status === 'completed') {
                    $query->where('end_date', '<', now());
                }
            })
            ->latest()
            ->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|in:workshop,seminar,hackathon,competition,other',
            'max_participants' => 'nullable|integer|min:1',
            'is_published' => 'boolean',
        ]);

        // Begin database transaction
        DB::beginTransaction();

        try {
            // Handle file upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('events', 'public');
            }

            // Create event
            $event = Event::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'slug' => Str::slug($validated['title']) . '-' . Str::random(6),
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'location' => $validated['location'],
                'image_url' => $imagePath,
                'category' => $validated['category'],
                'max_participants' => $validated['max_participants'],
                'is_published' => $request->boolean('is_published'),
            ]);

            // Commit transaction
            DB::commit();

            return redirect()->route('admin.events.index')
                ->with('success', 'Event created successfully!');

        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            // Delete uploaded file if event creation failed
            if (isset($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            return back()->withInput()
                ->with('error', 'Error creating event: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        // dd($request->all());
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|in:workshop,seminar,hackathon,competition,other',
            'max_participants' => 'nullable|integer|min:1',
            'is_published' => 'required|in:on,off',
        ]);

        $event->title = $validated['title'];
        $event->description = $validated['description'];
        $event->start_date = $validated['start_date'];
        $event->end_date = $validated['end_date'];
        $event->location = $validated['location'];
        $event->category = $validated['category'];
        $event->max_participants = $validated['max_participants'];
        $event->is_published = $request->has('is_published');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image_url) {
                Storage::disk('public')->delete($event->image_url);
            }

            $path = $request->file('image')->store('events', 'public');
            $event->image_url = $path;
        }

        $event->save();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        if ($event->image_url) {
            Storage::disk('public')->delete($event->image_url);
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully!');
    }
}