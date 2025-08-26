<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUBT IT Club - Bangladesh University of Business and Technology</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/b3e3482d82.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-50 font-sans">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-sm fixed w-full z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        {{-- <img class="h-36 w-auto" src="{{ asset('assets/logo.png') }}" alt="BUBT IT Club Logo"> --}}
                        <a href="{{ route('public.welcome') }}"><span class="ml-2 text-xl font-bold text-blue-800">BUBT
                                IT Club</span></a>
                    </div>
                </div>
                <div class="hidden md:ml-6 md:flex md:items-center md:space-x-8">
                    <a href="{{ route('public.welcome') }}"
                        class="{{ request()->routeIs('public.welcome') ? 'text-blue-800 border-b-2 border-blue-600' : 'text-gray-700 hover:text-blue-600' }} px-3 py-2 text-sm font-medium">Home</a>
                    <a href="{{ route('public.about') }}"
                        class="{{ request()->routeIs('public.about') ? 'text-blue-800 border-b-2 border-blue-600' : 'text-gray-700 hover:text-blue-600' }} px-3 py-2 text-sm font-medium">About</a>
                    <a href="{{ route('public.events') }}"
                        class="{{ request()->routeIs(['public.events', 'public.events.show', 'public.events.register.form']) ? 'text-blue-800 border-b-2 border-blue-600' : 'text-gray-700 hover:text-blue-600' }} px-3 py-2 text-sm font-medium">Events</a>
                    <a href="{{ route('public.projects') }}"
                        class="{{ request()->routeIs('public.projects') ? 'text-blue-800 border-b-2 border-blue-600' : 'text-gray-700 hover:text-blue-600' }} px-3 py-2 text-sm font-medium">Projects</a>
                    <a href="{{ route('public.members.index') }}"
                        class="{{ request()->routeIs(['public.members.index', 'public.members.show', 'public.members.register.form']) ? 'text-blue-800 border-b-2 border-blue-600' : 'text-gray-700 hover:text-blue-600' }} px-3 py-2 text-sm font-medium">Members</a>
                    <a href="{{ route('public.blogs.index') }}"
                        class="{{ request()->routeIs(['public.blogs.index', 'public.blogs.show']) ? 'text-blue-800 border-b-2 border-blue-600' : 'text-gray-700 hover:text-blue-600' }} px-3 py-2 text-sm font-medium">Blog</a>
                    <a href="{{ route('public.galleries.index') }}"
                        class="{{ request()->routeIs(['public.galleries.index', 'public.galleries.show']) ? 'text-blue-800 border-b-2 border-blue-600' : 'text-gray-700 hover:text-blue-600' }} px-3 py-2 text-sm font-medium">Galleries</a>
                    <a href="{{ route('members.login') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">Login</a>
                </div>
                <div class="-mr-2 flex items-center md:hidden">
                    <button type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-blue-600 hover:bg-gray-100 focus:outline-none"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('public.welcome') }}"
                    class="bg-blue-50 text-blue-800 block px-3 py-2 rounded-md text-base font-medium">Home</a>
                <a href="{{ route('public.about') }}"
                    class="text-gray-700 hover:bg-gray-50 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">About</a>
                <a href="{{ route('public.events') }}"
                    class="text-gray-700 hover:bg-gray-50 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">Events</a>
                <a href="{{ route('public.projects') }}"
                    class="text-gray-700 hover:bg-gray-50 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">Projects</a>
                <a href="{{ route('public.members.index') }}"
                    class="text-gray-700 hover:bg-gray-50 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">Members</a>
                <a href="{{ route('public.blogs.index') }}"
                    class="text-gray-700 hover:bg-gray-50 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">Blog</a>
                <a href="{{ route('public.galleries.index') }}"
                    class="text-gray-700 hover:bg-gray-50 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">Galleries</a>
                <a href="{{ route('members.login') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium bg-blue-600 text-white">Login</a>
            </div>
        </div>
    </nav>

    <!-- Alert Messages -->
    @if ($errors->any())
        <div class="fixed bottom-4 right-4 z-50 transition-all duration-300 transform translate-y-0 opacity-100">
            <div class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                @foreach ($errors->all() as $error)
                    <div class="text-sm text-red-700 font-medium">
                        {{ $error }}
                    </div>
                @endforeach
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="fixed bottom-4 right-4 z-50 transition-all duration-300 transform translate-y-0 opacity-100">
            <div class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if (session('success-trash'))
        <div class="fixed bottom-4 right-4 z-50 transition-all duration-300 transform translate-y-0 opacity-100">
            <div class="bg-red-400 text-white px-6 py-3 rounded-lg shadow-lg flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>{{ session('success-trash') }}</span>
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

    @if (session('success-delete'))
        <div class="fixed bottom-4 right-4 z-50 transition-all duration-300 transform translate-y-0 opacity-100">
            <div class="bg-red-600 text-white px-6 py-3 rounded-lg shadow-lg flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>{{ session('success-delete') }}</span>
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


    <!-- Page Content -->
    @if (isset($main))
        <main>
            {{ $main }}
        </main>
    @endif

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-12 pb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">BUBT IT Club</h3>
                    <p class="text-gray-400">Empowering the future of technology at Bangladesh University of Business
                        and Technology.</p>
                    <div class="flex space-x-4 mt-4">
                        <a href="https://www.facebook.com/BITCofficial" class="text-gray-400 hover:text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/company/bitcofficial/" class="text-gray-400 hover:text-white">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('public.welcome') }}" class="text-gray-400 hover:text-white">Home</a>
                        </li>
                        <li><a href="{{ route('public.about') }}" class="text-gray-400 hover:text-white">About Us</a>
                        </li>
                        <li><a href="{{ route('public.events') }}" class="text-gray-400 hover:text-white">Events</a>
                        </li>
                        <li><a href="{{ route('public.projects') }}"
                                class="text-gray-400 hover:text-white">Projects</a>
                        </li>
                        <li><a href="{{ route('public.members.index') }}"
                                class="text-gray-400 hover:text-white">Members</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Resources</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('public.blogs.index') }}"
                                class="text-gray-400 hover:text-white">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Tutorials</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Documentation</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Code Repository</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3"></i>
                            <span>BUBT IT Club, Building: 3, Room: 501 <br> Bangladesh University of Business and
                                Technology, Rupnagar, Mirpur-2,
                                Dhaka-1216</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3"></i>
                            <span>itclub@bubt.edu.bd</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3"></i>
                            <span>+880 123 456 789</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-6 flex flex-col md:flex-row justify-between items-center">
                <a href="{{ route('admin.index') }}" class="text-gray-400 text-sm">© {{ date('Y') }} BUBT IT Club. All rights reserved.</a>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('public.privacy.policy') }}"
                        class="text-gray-400 hover:text-white text-sm mr-4">Privacy Policy</a>
                    <a href="{{ route('public.terms.service') }}"
                        class="text-gray-400 hover:text-white text-sm">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Preline JS -->
    <script src="https://cdn.jsdelivr.net/npm/@preline/plugin@1.0.0/dist/preline.js"></script>
    <script>
        // Mobile menu toggle
        document.querySelector('[aria-controls="mobile-menu"]').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

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
