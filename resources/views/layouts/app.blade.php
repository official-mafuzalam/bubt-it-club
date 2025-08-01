<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUBT IT Club - Bangladesh University of Business and Technology</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 font-sans">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-sm fixed w-full z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="h-10 w-auto" src="https://bubt.edu.bd/assets/img/logo.png" alt="BUBT Logo">
                        <span class="ml-2 text-xl font-bold text-blue-800">BUBT IT Club</span>
                    </div>
                </div>
                <div class="hidden md:ml-6 md:flex md:items-center md:space-x-8">
                    <a href="#"
                        class="text-blue-800 border-b-2 border-blue-600 px-3 py-2 text-sm font-medium">Home</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">About</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Events</a>
                    <a href="#"
                        class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Projects</a>
                    <a href="#"
                        class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Members</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Blog</a>
                    <a href="#"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">Join
                        Us</a>
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
                <a href="#"
                    class="bg-blue-50 text-blue-800 block px-3 py-2 rounded-md text-base font-medium">Home</a>
                <a href="#"
                    class="text-gray-700 hover:bg-gray-50 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">About</a>
                <a href="#"
                    class="text-gray-700 hover:bg-gray-50 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">Events</a>
                <a href="#"
                    class="text-gray-700 hover:bg-gray-50 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">Projects</a>
                <a href="#"
                    class="text-gray-700 hover:bg-gray-50 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">Members</a>
                <a href="#"
                    class="text-gray-700 hover:bg-gray-50 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">Blog</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium bg-blue-600 text-white">Join
                    Us</a>
            </div>
        </div>
    </nav>
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
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
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
                        <li><a href="#" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Events</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Projects</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Members</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Resources</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Blog</a></li>
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
                            <span>BUBT IT Club, Bangladesh University of Business and Technology, Rupnagar, Mirpur-2,
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
                <p class="text-gray-400 text-sm">© 2023 BUBT IT Club. All rights reserved.</p>
                <div class="mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white text-sm mr-4">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Terms of Service</a>
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
    </script>
</body>

</html>
