<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    private $filePath = 'announcement.json';

    /**
     * Display the current announcement.
     */
    public function index()
    {
        $announcement = $this->getAnnouncement();
        return view('admin.announcements.index', compact('announcement'));
    }

    /**
     * Show the form for creating or updating an announcement.
     */
    public function create()
    {
        $announcement = $this->getAnnouncement();
        return view('admin.announcements.create', compact('announcement'));
    }

    /**
     * Store or update the single announcement.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'image' => 'nullable|image|max:2048', // 2MB max
            'target_url' => 'nullable|url|max:255',
            'status' => 'required|boolean',
        ]);

        // Handle file upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('announcements', 'public');
        }

        // Create announcement array
        $announcement = [
            'status' => $validated['status'],
            'title' => $validated['title'],
            'message' => $validated['message'],
            'image' => $imagePath,
            'target_url' => $validated['target_url'] ?? null,
            'created_at' => now()->toDateTimeString(),
        ];

        // Save to JSON
        Storage::disk('local')->put($this->filePath, json_encode($announcement, JSON_PRETTY_PRINT));

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement saved successfully!');
    }

    /**
     * Helper to get announcement.
     */
    private function getAnnouncement()
    {
        if (Storage::exists($this->filePath)) {
            return json_decode(Storage::get($this->filePath), true);
        }
        return null;
    }

    /**
     * Toggle the status of the announcement.
     */
    public function toggleStatus()
    {
        $announcement = $this->getAnnouncement();

        if (!$announcement) {
            return redirect()->route('admin.announcements.index')
                ->with('error', 'No announcement found to update.');
        }

        // Toggle the status
        $announcement['status'] = !$announcement['status'];

        // Save to JSON
        Storage::disk('local')->put($this->filePath, json_encode($announcement, JSON_PRETTY_PRINT));

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement status updated successfully!');
    }
}
