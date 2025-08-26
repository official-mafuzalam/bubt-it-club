<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    protected $categories = [
        'Coding',
        'Design',
        'Management',
        'Networking',
        'Content Writing',
        'Graphics',
        'Photography',
        'Anchoring'
    ];


    public function show()
    {
        $authMember = Auth::guard('member')->user();
        $member = Member::find($authMember->id);
        return view('members.profile', compact('member'));
    }

    public function edit()
    {
        $categories = $this->categories;
        $member = Auth::guard('member')->user();
        return view('members.profile-edit', compact('member', 'categories'));
    }

    public function update(Request $request)
    {
        $authMember = Auth::guard('member')->user();
        $member = Member::find($authMember->id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('members')->ignore($member->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'student_id' => ['required', 'string', Rule::unique('members')->ignore($member->id)],
            'department' => 'required|string|max:255',
            'intake' => 'required|integer|min:1|max:99',
            'phone' => 'nullable|string|max:20',
            'gender' => 'required|in:male,female,other',
            'bio' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_links.*' => 'nullable|url',
            'favorite_categories' => 'nullable|array',
            'favorite_categories.*' => 'string|max:255',
            'is_active' => 'boolean',
            'contact_public' => 'boolean',
            'social_links_public' => 'boolean',
        ]);

        // Handle file upload with student_id as filename
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($member->photo_url) {
                Storage::disk('public')->delete($member->photo_url);
            }

            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileName = $validated['student_id'] . '.' . $extension; // student_id as filename
            $path = $request->file('photo')->storeAs('member-photos', $fileName, 'public');
            $validated['photo_url'] = $path;
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

        return redirect()->route('members.profile')
            ->with('success', 'Profile updated successfully.');
    }


}
