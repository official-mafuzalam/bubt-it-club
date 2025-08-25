@component('mail::message')
    # Welcome, {{ $member->name }}! 🎉

    Hello {{ $member->name }},

    We are excited to welcome you as a **{{ $member->position }}** of the **BUBT IT Club**.

    Here are your details:

    - **Student ID:** {{ $member->student_id }}
    - **Department:** {{ $member->department }}
    - **Intake:** {{ $member->intake }}
    - **Joined At:** {{ $member->joined_at->format('F d, Y') }}
    - **Email:** {{ $member->email }}
    - **Password:** {{ $member->password }}

    @if ($member->photo_url)
        <img src="{{ asset('storage/' . $member->photo_url) }}" alt="{{ $member->name }}" width="150">
    @endif


    @component('mail::button', ['url' => route('members.login')])
        Login Here
    @endcomponent

    @component('mail::button', ['url' => route('public.welcome')])
        Visit Our Website
    @endcomponent


    Thanks for joining us!
    **BUBT IT Club Team**
    {{ config('app.name') }}
@endcomponent
