{{-- resources/views/components/member-layout.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUBT IT Club - Member Dashboard</title>

    <!-- Tailwind & Preline -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/preline@1.5.0/dist/preline.js"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/b3e3482d82.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex-shrink-0">
            <div class="p-4 font-bold text-lg border-b border-gray-200 dark:border-gray-700">
                IT Club Members
            </div>
            <nav class="mt-4">
                <ul>
                    <li>
                        <a href="{{ route('members.dashboard') }}"
                            class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 rounded
                                @if (request()->routeIs('members.dashboard')) bg-gray-200 dark:bg-gray-700 @else hover:bg-gray-200 dark:hover:bg-gray-700 @endif">
                            <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('members.profile') }}"
                            class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 rounded
                                @if (request()->routeIs('members.profile', 'members.profile.*')) bg-gray-200 dark:bg-gray-700 @else hover:bg-gray-200 dark:hover:bg-gray-700 @endif">
                            <i class="fas fa-user w-5 h-5 mr-3"></i>
                            Profile
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('public.welcome') }}" target="_blank"
                            class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 rounded
                                @if (request()->routeIs('public.welcome')) bg-gray-200 dark:bg-gray-700 @else hover:bg-gray-200 dark:hover:bg-gray-700 @endif">
                            <i class="fas fa-globe w-5 h-5 mr-3"></i>
                            Main Site
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('members.logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 rounded">
                                <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-auto">

            <!-- Top Navbar -->
            <header class="bg-white dark:bg-gray-800 shadow p-4 flex justify-between items-center">
                <h1 class="text-xl font-bold">Dashboard</h1>
                <div class="flex items-center space-x-4">
                    @php
                        $member = auth('member')->user();
                    @endphp
                    <span class="font-medium">Hi, {{ $member->name }}</span>
                    <img src="{{ $member->photo_url ? asset('storage/' . $member->photo_url) : 'https://ui-avatars.com/api/?name=' . $member->name }}"
                        alt="Avatar" class="w-10 h-10 rounded-full border border-gray-300 dark:border-gray-600">
                </div>
            </header>

            <!-- Alert Messages -->
            @if ($errors->any())
                <div
                    class="fixed bottom-4 right-4 z-50 transition-all duration-300 transform translate-y-0 opacity-100">
                    <div class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        @foreach ($errors->all() as $error)
                            <div class="text-sm text-red-700 font-medium">
                                {{ $error }}
                            </div>
                        @endforeach
                        <button onclick="this.parentElement.parentElement.remove()" class="ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div
                    class="fixed bottom-4 right-4 z-50 transition-all duration-300 transform translate-y-0 opacity-100">
                    <div class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span>{{ session('success') }}</span>
                        <button onclick="this.parentElement.parentElement.remove()" class="ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Main slot -->
            <main class="p-6 bg-gray-100 dark:bg-gray-900 flex-1 overflow-auto">
                {{ $main }}
            </main>

        </div>
    </div>

    <script>
        // Auto-close notifications after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                const notifications = document.querySelectorAll(
                    '[class*="fixed"][class*="bottom-4"][class*="right-4"]');
                notifications.forEach(notification => {
                    notification.remove();
                });
            }, 5000);
        });
    </script>
</body>

</html>
