<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExecutiveCommittee;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ExecutiveCommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $committees = ExecutiveCommittee::orderBy('term_start', 'desc')->get();
        return view('admin.members.executive.index', compact('committees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.members.executive.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'term_start' => 'required|date',
            'term_end' => 'required|date|after:term_start',
            'description' => 'required|string|max:1000',
        ]);

        ExecutiveCommittee::create($validated);

        return redirect()->route('admin.executive-committees.index')
            ->with('success', 'Executive committee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExecutiveCommittee $executiveCommittee): View
    {
        $executiveCommittee->load('members');
        return view('admin.members.executive.show', compact('executiveCommittee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExecutiveCommittee $executiveCommittee): View
    {
        return view('admin.members.executive.edit', compact('executiveCommittee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExecutiveCommittee $executiveCommittee): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'term_start' => 'required|date',
            'term_end' => 'required|date|after:term_start',
            'description' => 'nullable|string|max:1000',
        ]);

        $executiveCommittee->update($validated);

        return redirect()->route('admin.executive-committees.index')
            ->with('success', 'Executive committee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExecutiveCommittee $executiveCommittee): RedirectResponse
    {
        // Check if committee has members before deleting
        if ($executiveCommittee->members()->count() > 0) {
            return redirect()->route('admin.executive-committees.index')
                ->with('error', 'Cannot delete committee that has members. Please reassign members first.');
        }

        $executiveCommittee->delete();

        return redirect()->route('admin.executive-committees.index')
            ->with('success', 'Executive committee deleted successfully.');
    }

    /**
     * Get current active executive committee
     */
    public function current(): View
    {
        $currentCommittee = ExecutiveCommittee::where('term_start', '<=', now())
            ->where('term_end', '>=', now())
            ->first();

        return view('admin.members.executive.current', compact('currentCommittee'));
    }
}