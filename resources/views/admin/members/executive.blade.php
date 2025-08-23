<x-admin-layout>
    <x-slot name="main">
        @section('page-title')
            <title>Assign Executive Committee | BUBT IT Club</title>
        @endsection

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Assign Executive Committee
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Assign committee position for {{ $member->name }}
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.members.show', $member) }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-150 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Member
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-800">
            <form action="{{ route('admin.members.assign-executive', $member) }}" method="POST">
                @csrf
                <div class="p-6 space-y-6">
                    <!-- Member Information -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Member Information</h3>
                        <div class="flex items-center">
                            <img class="h-16 w-16 rounded-full object-cover mr-4"
                                src="{{ $member->photo_url ? asset('storage/' . $member->photo_url) : 'https://ui-avatars.com/api/?name=' . urlencode($member->name) . '&color=7F9CF5&background=EBF4FF' }}"
                                alt="{{ $member->name }}">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $member->name }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-300">{{ $member->student_id }} |
                                    {{ $member->department }}, Intake {{ $member->intake }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-300">{{ $member->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Current Assignment -->
                    {{-- @if ($executive)
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border-l-4 border-blue-500">
                            <h3 class="text-lg font-medium text-blue-900 dark:text-blue-100 mb-2">Current Committee
                                Assignment</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-blue-800 dark:text-blue-200"><span
                                            class="font-semibold">Committee:</span> {{ $executive->name }}</p>
                                    <p class="text-sm text-blue-800 dark:text-blue-200"><span
                                            class="font-semibold">Term:</span>
                                        {{ $executive->term_start->format('M Y') }} -
                                        {{ $executive->term_end->format('M Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-blue-800 dark:text-blue-200"><span
                                            class="font-semibold">Position:</span> {{ $member->position }}</p>
                                    <p class="text-sm text-blue-800 dark:text-blue-200"><span
                                            class="font-semibold">Status:</span>
                                        <span
                                            class="px-2 py-1 text-xs rounded-full {{ $executive->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                            {{ $executive->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif --}}

                    <!-- Assignment Form -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Committee Assignment</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="executive_committee_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Select Committee <span class="text-red-500">*</span>
                                </label>
                                <select name="executive_committee_id" id="executive_committee_id" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select Committee</option>
                                    @foreach ($committees as $committee)
                                        <option value="{{ $committee->id }}"
                                            {{ old('executive_committee_id', $member->executive_committee_id) == $committee->id ? 'selected' : '' }}>
                                            {{ $committee->name }} ({{ $committee->term_start->format('M Y') }} -
                                            {{ $committee->term_end->format('M Y') }})
                                            {{ $committee->is_active ? ' - Active' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('executive_committee_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="remove_assignment" id="remove_assignment"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    {{ old('remove_assignment') ? 'checked' : '' }}>
                                <span class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Remove committee assignment (set as General Member)
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="flex items-center justify-end p-6 bg-gray-50 dark:bg-gray-700 space-x-3">
                    <a href="{{ route('admin.members.show', $member) }}"
                        class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800">
                        Cancel
                    </a>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Save Assignment
                    </button>
                </div>
            </form>
        </div>
    </x-slot>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const removeCheckbox = document.getElementById('remove_assignment');
                const committeeSelect = document.getElementById('executive_committee_id');
                const positionSelect = document.getElementById('position');

                removeCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        committeeSelect.disabled = true;
                        positionSelect.disabled = true;
                        committeeSelect.value = '';
                        positionSelect.value = '';
                    } else {
                        committeeSelect.disabled = false;
                        positionSelect.disabled = false;
                    }
                });

                // Initialize state on page load
                if (removeCheckbox.checked) {
                    committeeSelect.disabled = true;
                    positionSelect.disabled = true;
                }
            });
        </script>
    @endpush
</x-admin-layout>
