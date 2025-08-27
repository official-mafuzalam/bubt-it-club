<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Mail\MemberCreated;
use App\Models\ExecutiveCommittee;
use App\Models\Member;
use App\Models\MembershipPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            'payment_method' => 'required|string|in:hand_cash,bkash,nagad,rocket',
            'amount' => 'required|numeric|min:0',
            'transaction_id' => 'nullable|string|max:255',
            'terms' => 'required|accepted',
        ]);

        try {
            DB::beginTransaction();

            // Handle photo upload (filename = student_id)
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $extension = $request->file('photo')->getClientOriginalExtension();
                $fileName = $validated['student_id'] . '.' . $extension; // e.g. 20250001.jpg
                $photoPath = $request->file('photo')->storeAs('member-photos', $fileName, 'public');
            }

            // Create Member
            $member = Member::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'student_id' => $validated['student_id'],
                'department' => $validated['department'],
                'intake' => $validated['intake'],
                'phone' => $validated['phone'] ?? null,
                'gender' => $validated['gender'],
                'photo_url' => $photoPath,
                'joined_at' => now(),
            ]);

            // Create Payment Record
            MembershipPayment::create([
                'member_id' => $member->id,
                'amount' => $validated['amount'],
                'status' => 'pending',
                'payment_method' => $validated['payment_method'],
                'transaction_id' => $validated['transaction_id'] ?? null,
            ]);

            // Send Welcome Email
            Mail::to($member->email)->send(new MemberCreated($member));

            DB::commit();

            return redirect()->route('public.members.show', $member)
                ->with('success', 'Registration successful! Welcome to BUBT IT Club.');

        } catch (\Throwable $e) {
            DB::rollBack();

            // Optionally log the error
            Log::error('Member registration failed: ' . $e->getMessage());

            return back()
                ->withErrors(['error' => 'Something went wrong during registration. ' . $e->getMessage()])
                ->withInput();
        }
    }


    /**
     * Display the specified member.
     */
    public function show(Member $member)
    {
        if (!$member->is_active) {
            return redirect()->route('public.members.index')
                ->with('error', 'The requested member profile is not available.');
        }

        return view('public.members.show', compact('member'));
    }
}