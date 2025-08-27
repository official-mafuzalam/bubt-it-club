<x-admin-layout>
    <x-slot name="main">
        @section('page-title')
            <title>{{ $member->name }} | BUBT IT Club</title>
        @endsection

        <!-- Header & Action Buttons -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Member Details</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    View all information about {{ $member->name }}
                </p>
            </div>
        </div>

        <!-- Profile Section -->
        <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800 p-6 mb-4">
            <div class="flex flex-wrap gap-2 mt-4">
                <a href="{{ route('admin.members.executive', $member->id) }}"
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-150">
                    Add To Executive
                </a>

                <a href="{{ route('admin.members.edit', $member->id) }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-150">
                    Edit Member
                </a>

                <form action="{{ route('admin.members.email-confirmation', $member->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-150">
                        Resend Email
                    </button>
                </form>

                <form action="{{ route('admin.members.password.reset', $member->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition duration-150">
                        Reset Password
                    </button>
                </form>

                <form action="{{ route('admin.members.toggle-activation', $member->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 rounded-md text-white transition duration-150 
                    {{ $member->is_active ? 'bg-gray-600 hover:bg-gray-700' : 'bg-green-600 hover:bg-green-700' }}">
                        {{ $member->is_active ? 'Deactivate' : 'Activate' }}
                    </button>
                </form>

                <form action="{{ route('admin.members.toggle-verification', $member->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 rounded-md text-white transition duration-150 
                    {{ $member->is_verified ? 'bg-gray-600 hover:bg-gray-700' : 'bg-blue-600 hover:bg-blue-700' }}">
                        {{ $member->is_verified ? 'Unverify' : 'Verify' }}
                    </button>
                </form>

                @php
                    $latestPayment = $member->payments()->latest()->first();
                    $isPaid = $latestPayment && $latestPayment->status === 'completed';
                @endphp
                <form action="{{ route('admin.members.payments', $member->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                        class="px-4 py-2 rounded-md text-white transition duration-150
                    {{ $isPaid ? 'bg-green-600 hover:bg-green-700' : 'bg-yellow-600 hover:bg-yellow-700' }}">
                        {{ $isPaid ? 'Mark as Pending' : 'Mark as Paid' }}
                    </button>
                </form>

                <form action="{{ route('admin.members.add-to-user', $member->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 transition duration-150">
                        Add To User
                    </button>
                </form>

                <a href="{{ route('admin.members.index') }}"
                    class="px-4 py-2 bg-gray-400 text-gray-700 rounded-md hover:bg-gray-300 transition duration-150">
                    Back to Members
                </a>
            </div>
        </div>


        <!-- Profile Section -->
        <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800 p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Left Column: Profile -->
                <div class="md:col-span-1 flex flex-col items-center">
                    @if ($member->photo_url)
                        <img class="h-32 w-32 rounded-full object-cover mb-4"
                            src="{{ asset('storage/' . $member->photo_url) }}" alt="{{ $member->name }}">
                    @else
                        <div class="h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center mb-4">
                            <span class="text-4xl text-gray-500">{{ strtoupper(substr($member->name, 0, 1)) }}</span>
                        </div>
                    @endif

                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ $member->name }}</h2>
                    @if ($member->position)
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $member->position }}</p>
                    @endif

                    <!-- Payment Status with Tooltip -->
                    <div class="mt-4 flex flex-col items-center">
                        @if ($member->payments->count() > 0)
                            @foreach ($member->payments as $payment)
                                @php
                                    $bgClass = match ($payment->status) {
                                        'completed' => 'bg-green-100 text-green-800',
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'failed' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <div class="mb-2 relative group">
                                    <span
                                        class="px-2 inline-flex text-xs font-semibold rounded-full {{ $bgClass }} cursor-pointer">
                                        Paid via {{ ucfirst($payment->payment_method) }}
                                    </span>
                                    <div
                                        class="absolute left-1/2 transform -translate-x-1/2 -top-10 hidden group-hover:block w-max max-w-xs bg-gray-800 text-white text-xs rounded-md shadow-lg p-2 z-10">
                                        <p>Method: {{ ucfirst($payment->payment_method) }}</p>
                                        <p>Amount: {{ $payment->amount }} TK</p>
                                        <p>Status: {{ ucfirst($payment->status) }}</p>
                                        <p>Transaction ID: {{ $payment->transaction_id ?? 'N/A' }}</p>
                                        <p>Date: {{ $payment->created_at->format('d M Y, h:i A') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <span
                                class="px-2 inline-flex text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Unpaid</span>
                        @endif
                    </div>
                </div>

                <!-- Right Column: Info -->
                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Personal Info -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white border-b pb-2">Personal Information
                        </h3>
                        <x-info-row label="Email" :value="$member->email" />
                        <x-info-row label="Phone" :value="$member->phone ?? 'N/A'" />
                        <x-info-row label="Gender" :value="$member->gender" capitalize="true" />
                        <x-info-row label="Joined Date" :value="$member->joined_at->format('d M Y')" />
                        <x-info-status label="Status" :status="$member->is_active" :trueColor="'green'" :falseColor="'gray'"
                            trueText="Active" falseText="Inactive" />
                    </div>

                    <!-- Academic Info -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white border-b pb-2">Academic Information
                        </h3>
                        <x-info-row label="Student ID" :value="$member->student_id" />
                        <x-info-row label="Department" :value="$member->department" />
                        <x-info-row label="Intake" :value="$member->intake" />
                        <x-info-status label="Verified Status" :status="$member->is_verified" :trueColor="'blue'" :falseColor="'gray'"
                            trueText="Verified" falseText="Unverified" />
                    </div>
                </div>
            </div>

            <!-- Bio Section -->
            @if ($member->bio)
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white border-b pb-2">Bio</h3>
                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $member->bio }}
                    </p>
                </div>
            @endif

            <!-- Favorite Categories -->
            @php
                $favoriteCategories = is_array($member->favorite_categories)
                    ? $member->favorite_categories
                    : json_decode($member->favorite_categories, true) ?? [];
            @endphp
            @if (!empty($favoriteCategories))
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white border-b pb-2">Favorite Categories</h3>
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach ($favoriteCategories as $category)
                            <span
                                class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">{{ $category }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Events Section -->
        <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800 mt-6 mb-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white border-b p-4">Events Participated</h3>
            @if ($registrations->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">
                                    Event</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">
                                    Date</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">
                                    Department</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">
                                    Attended</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($registrations as $registration)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                        {{ $registration->event->title }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                        {{ $registration->event->start_date->format('d M Y') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                        {{ $registration->department }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 inline-flex text-xs font-semibold rounded-full {{ $registration->attended ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $registration->attended ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-6 text-center text-sm text-gray-500 dark:text-gray-400">
                    This member hasn't participated in any events yet.
                </div>
            @endif
        </div>
    </x-slot>
</x-admin-layout>

{{-- Recommended: Define reusable Tailwind classes in a CSS component --}}
<style>
    .btn-action {
        @apply inline-flex items-center px-4 py-2 border border-transparent rounded-md font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors duration-150;
    }
</style>
