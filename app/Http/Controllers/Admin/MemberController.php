<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    protected $departments = [
        'CSE',
        'EEE',
        'Mathematics & Statistics',
        'Textile Engineering',
        'Civil Engineering',
        'Architecture',
        'BBA',
        'English',
        'Economics',
        'Law & Justice',
        'Finance',
        'Management',
        'Accounting',
        'Marketing'
    ];
    protected $positions = [
        'President',
        'Vice President',
        'Vice President (Female)',
        'General Secretary',
        'Joint Secretary 1',
        'Joint Secretary 2',
        'Treasurer',
        'Joint Treasurer',
        'Organizing Secretary',
        'Event Secretary',
        'Media Secretary',
        'Office Secretary',
        'Social Welfare Secretary',
        'Executive Member',
        'General Member'
    ];
    protected $categories = ['Coding', 'Design', 'Management', 'Networking', 'Content Writing', 'Graphics', 'Photography', 'Anchoring'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::latest()
            ->filter(request(['search', 'department', 'intake', 'status']))
            ->paginate(10);

        $departments = Member::select('department')
            ->distinct()
            ->pluck('department');

        $intakes = Member::select('intake')
            ->distinct()
            ->orderBy('intake', 'desc')
            ->pluck('intake');

        return view('admin.members.index', compact('members', 'departments', 'intakes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = $this->departments;
        $positions = $this->positions;
        $categories = $this->categories;
        return view('admin.members.create', compact('departments', 'positions', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'password' => 'required|string|min:8|confirmed',
            'student_id' => 'required|string|unique:members,student_id',
            'department' => 'required|string|max:255',
            'intake' => 'required|integer|min:1|max:99',
            'phone' => 'nullable|string|max:20',
            'gender' => 'required|in:male,female,other',
            'position' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_links.*' => 'nullable|url',
            'favorite_categories' => 'nullable|array',
            'favorite_categories.*' => 'string|max:255',
            'is_active' => 'boolean',
            'joined_at' => 'required|date',
        ]);

        // Handle file upload
        if ($request->hasFile('photo')) {
            $validated['photo_url'] = $request->file('photo')->store('member-photos', 'public');
        }

        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        // Convert arrays to JSON
        $validated['social_links'] = $request->social_links ? json_encode($request->social_links) : null;
        $validated['favorite_categories'] = $request->favorite_categories ? json_encode($request->favorite_categories) : null;

        Member::create($validated);

        return redirect()->route('admin.members.index')
            ->with('success', 'Member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        return view('admin.members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        $departments = $this->departments;
        $positions = $this->positions;
        $categories = $this->categories;

        return view('admin.members.edit', compact('member', 'departments', 'positions', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('members')->ignore($member->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'student_id' => ['required', 'string', Rule::unique('members')->ignore($member->id)],
            'department' => 'required|string|max:255',
            'intake' => 'required|integer|min:1|max:99',
            'phone' => 'nullable|string|max:20',
            'gender' => 'required|in:male,female,other',
            'position' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_links.*' => 'nullable|url',
            'favorite_categories' => 'nullable|array',
            'favorite_categories.*' => 'string|max:255',
            'is_active' => 'boolean',
            'joined_at' => 'required|date',
        ]);

        // Handle file upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($member->photo_url) {
                Storage::disk('public')->delete($member->photo_url);
            }
            $validated['photo_url'] = $request->file('photo')->store('member-photos', 'public');
        }

        // Update password if provided
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Convert arrays to JSON
        $validated['social_links'] = $request->social_links ? json_encode($request->social_links) : $member->social_links;
        $validated['favorite_categories'] = $request->favorite_categories ? json_encode($request->favorite_categories) : $member->favorite_categories;

        $member->update($validated);

        return redirect()->route('admin.members.index')
            ->with('success', 'Member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        // Delete photo if exists
        if ($member->photo_url) {
            Storage::disk('public')->delete($member->photo_url);
        }

        $member->delete();

        return redirect()->route('admin.members.index')
            ->with('success', 'Member deleted successfully.');
    }

    /**
     * Restore the specified soft deleted resource.
     */
    public function restore($id)
    {
        $member = Member::withTrashed()->findOrFail($id);
        $member->restore();

        return redirect()->route('admin.members.index')
            ->with('success', 'Member restored successfully.');
    }

    /**
     * Permanently delete the specified resource.
     */
    public function forceDelete($id)
    {
        $member = Member::withTrashed()->findOrFail($id);

        // Delete photo if exists
        if ($member->photo_url) {
            Storage::disk('public')->delete($member->photo_url);
        }

        $member->forceDelete();

        return redirect()->route('admin.members.index')
            ->with('success', 'Member permanently deleted.');
    }
}