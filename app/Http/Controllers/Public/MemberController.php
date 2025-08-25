<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Mail\MemberCreated;
use App\Models\ExecutiveCommittee;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class MemberController extends Controller
{
    /**
     * Display a listing of members.
     */
    public function index(Request $request)
    {
        $members = Member::query()
            ->where('is_active', true)
            ->when($request->filled('department'), function ($query) use ($request) {
                $query->where('department', $request->department);
            })
            ->when($request->filled('intake'), function ($query) use ($request) {
                $query->where('intake', $request->intake);
            })
            ->orderBy('intake', 'desc')
            ->orderBy('name')
            ->paginate(12);

        $executiveMembers = Member::query()
            ->executiveMembers()
            ->get();

        $executiveCommittees = ExecutiveCommittee::all();

        $departments = Member::select('department')
            ->distinct()
            ->pluck('department');

        $intakes = Member::select('intake')
            ->distinct()
            ->orderBy('intake', 'desc')
            ->pluck('intake');

        return view('public.members.index', compact('members', 'departments', 'intakes', 'executiveMembers', 'executiveCommittees'));
    }

    /**
     * Show the member registration form.
     */
    public function showRegistrationForm()
    {
        $departments = [
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
        return view('public.members.register', compact('departments'));
    }

    /**
     * Register a new member.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'student_id' => 'required|string|unique:members,student_id',
            'department' => 'required|string|in:CSE,EEE,BBA,MBA',
            'intake' => 'required|integer',
            'phone' => 'nullable|string|max:20',
            'gender' => 'required|in:male,female,other',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'terms' => 'required|accepted',
        ]);

        // Handle photo upload (filename = student_id)
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileName = $validated['student_id'] . '.' . $extension; // e.g. 20250001.jpg
            $photoPath = $request->file('photo')->storeAs('member-photos', $fileName, 'public');
        }

        // Create member
        $member = Member::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'student_id' => $validated['student_id'],
            'department' => $validated['department'],
            'intake' => $validated['intake'],
            'phone' => $validated['phone'],
            'gender' => $validated['gender'],
            'photo_url' => $photoPath,
            'joined_at' => now(),
        ]);

        Mail::to($member->email)->send(new MemberCreated($member));

        return redirect()->route('public.members.show', $member)
            ->with('success', 'Registration successful! Welcome to BUBT IT Club.');
    }


    /**
     * Display the specified member.
     */
    public function show(Member $member)
    {
        if (!$member->is_active) {
            abort(404);
        }

        // $member->load(['projects' => function ($query) {
        //     $query->where('is_published', true)
        //         ->orderBy('created_at', 'desc')
        //         ->limit(5);
        // }, 'events' => function ($query) {
        //     $query->where('is_published', true)
        //         ->orderBy('start_date', 'desc')
        //         ->limit(5);
        // }]);

        return view('public.members.show', compact('member'));
    }
}