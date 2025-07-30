<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUBT IT Club - Bangladesh University of Business and Technology</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Preline UI -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@preline/plugin@1.0.0/dist/preline.css">
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

    <!-- Hero Section -->
    <header class="pt-24 pb-12 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="md:w-1/2">
                    <h1 class="text-4xl font-bold leading-tight mb-4">Welcome to BUBT IT Club</h1>
                    <p class="text-xl mb-8">Empowering the future of technology at Bangladesh University of Business and
                        Technology</p>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="bg-white text-blue-800 px-6 py-3 rounded-lg font-medium hover:bg-gray-100 transition duration-300">Explore
                            Events</a>
                        <a href="#"
                            class="border border-white text-white px-6 py-3 rounded-lg font-medium hover:bg-white hover:text-blue-800 transition duration-300">Learn
                            More</a>
                    </div>
                </div>
                <div class="md:w-1/2 mt-8 md:mt-0">
                    <img src="https://images.unsplash.com/photo-1522542550221-31fd19575a2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                        alt="IT Club Members" class="rounded-lg shadow-xl">
                </div>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">What We Offer</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">We provide a platform for students to enhance their
                    technical skills and collaborate on innovative projects.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                    <div class="text-blue-600 mb-4">
                        <i class="fas fa-laptop-code text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Workshops & Training</h3>
                    <p class="text-gray-600">Regular workshops on programming, web development, AI, and other emerging
                        technologies.</p>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                    <div class="text-blue-600 mb-4">
                        <i class="fas fa-users text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Tech Community</h3>
                    <p class="text-gray-600">Connect with like-minded students and build a strong professional network.
                    </p>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg shadow-sm hover:shadow-md transition duration-300">
                    <div class="text-blue-600 mb-4">
                        <i class="fas fa-trophy text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Competitions</h3>
                    <p class="text-gray-600">Participate in hackathons, coding contests, and other tech challenges.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Upcoming Events -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Upcoming Events</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Join our upcoming events to learn, compete, and
                    network.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Event Card 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                        alt="Hackathon" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span>June 15, 2023</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Annual Hackathon 2023</h3>
                        <p class="text-gray-600 mb-4">24-hour coding competition to solve real-world problems with
                            innovative solutions.</p>
                        <a href="#"
                            class="text-blue-600 font-medium hover:text-blue-800 inline-flex items-center">
                            Learn More
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Event Card 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                        alt="Workshop" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span>June 22, 2023</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Web Development Workshop</h3>
                        <p class="text-gray-600 mb-4">Hands-on training on modern web development with Laravel and
                            Vue.js.</p>
                        <a href="#"
                            class="text-blue-600 font-medium hover:text-blue-800 inline-flex items-center">
                            Learn More
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Event Card 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                        alt="Seminar" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span>July 5, 2023</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">AI & Machine Learning Seminar</h3>
                        <p class="text-gray-600 mb-4">Learn about the latest trends in AI from industry experts.</p>
                        <a href="#"
                            class="text-blue-600 font-medium hover:text-blue-800 inline-flex items-center">
                            Learn More
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-10">
                <a href="#"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    View All Events
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">What Our Members Say</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Hear from students who have benefited from our
                    programs.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            <img class="h-12 w-12 rounded-full" src="https://randomuser.me/api/portraits/women/32.jpg"
                                alt="Testimonial">
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-medium">Tasnim Ahmed</h4>
                            <p class="text-gray-500">CSE '22</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"The web development workshop helped me land my internship at a top tech
                        company. The hands-on approach was incredibly valuable."</p>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            <img class="h-12 w-12 rounded-full" src="https://randomuser.me/api/portraits/men/45.jpg"
                                alt="Testimonial">
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-medium">Rakib Hasan</h4>
                            <p class="text-gray-500">SWE '21</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"Participating in the hackathons organized by IT Club gave me the
                        confidence and skills to start my own tech startup."</p>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            <img class="h-12 w-12 rounded-full" src="https://randomuser.me/api/portraits/women/68.jpg"
                                alt="Testimonial">
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-medium">Farhana Islam</h4>
                            <p class="text-gray-500">CSE '23</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"The networking opportunities through IT Club connected me with alumni
                        working at companies I aspire to join after graduation."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 bg-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-6">Ready to Join BUBT IT Club?</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto">Become part of our growing community of tech enthusiasts and take
                your skills to the next level.</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="#"
                    class="bg-white text-blue-800 px-8 py-3 rounded-lg font-medium hover:bg-gray-100 transition duration-300">Register
                    Now</a>
                <a href="#"
                    class="border border-white text-white px-8 py-3 rounded-lg font-medium hover:bg-white hover:text-blue-800 transition duration-300">Contact
                    Us</a>
            </div>
        </div>
    </section>

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
