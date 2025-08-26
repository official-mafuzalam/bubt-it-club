<x-admin-layout>
    @section('page-title')
        <title>Dashboard | BUBT IT Club</title>
    @endsection

    <x-slot name="main">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Welcome {{ Auth::user()->name }}!
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                    <!-- Total Members -->
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 flex items-center">
                        <i class="fas fa-users text-blue-500 text-4xl mr-4"></i>
                        <div>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Total Members</p>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $numbersOfMembers }}</h2>
                        </div>
                    </div>

                    <!-- Active Members -->
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 flex items-center">
                        <i class="fas fa-user-check text-green-500 text-4xl mr-4"></i>
                        <div>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Active Members</p>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $numbersOfActiveMembers }}
                            </h2>
                        </div>
                    </div>

                    <!-- Inactive Members -->
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 flex items-center">
                        <i class="fas fa-user-times text-red-500 text-4xl mr-4"></i>
                        <div>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Inactive Members</p>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $numbersOfInactiveMembers }}
                            </h2>
                        </div>
                    </div>

                    <!-- Completed Events -->
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 flex items-center">
                        <i class="fas fa-calendar-check text-purple-500 text-4xl mr-4"></i>
                        <div>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Completed Events</p>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $completedEvents }}</h2>
                        </div>
                    </div>

                    <!-- Ongoing Events -->
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 flex items-center">
                        <i class="fas fa-calendar-day text-yellow-500 text-4xl mr-4"></i>
                        <div>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Ongoing Events</p>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $ongoingEvents }}</h2>
                        </div>
                    </div>

                    <!-- Upcoming Events -->
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 flex items-center">
                        <i class="fas fa-calendar-plus text-indigo-500 text-4xl mr-4"></i>
                        <div>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Upcoming Events</p>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $upcomingEvents }}</h2>
                        </div>
                    </div>

                    <!-- Projects -->
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 flex items-center">
                        <i class="fas fa-project-diagram text-teal-500 text-4xl mr-4"></i>
                        <div>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Projects</p>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $projects }}</h2>
                        </div>
                    </div>

                    <!-- Blog Posts -->
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 flex items-center">
                        <i class="fas fa-blog text-pink-500 text-4xl mr-4"></i>
                        <div>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Blog Posts</p>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $blogs }}</h2>
                        </div>
                    </div>

                    <!-- Galleries -->
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 flex items-center">
                        <i class="fas fa-images text-orange-500 text-4xl mr-4"></i>
                        <div>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Galleries</p>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $galleries }}</h2>
                        </div>
                    </div>

                    <!-- Contacts -->
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 flex items-center">
                        <i class="fas fa-envelope text-gray-500 text-4xl mr-4"></i>
                        <div>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Contacts</p>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $contacts }}</h2>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </x-slot>
</x-admin-layout>
