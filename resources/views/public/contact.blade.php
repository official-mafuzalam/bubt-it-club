<x-app-layout>
    <x-slot name="main">
        <!-- Hero Section -->
        <header class="pt-24 pb-12 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold leading-tight mb-4">Contact Us</h1>
                <p class="text-xl mb-8">Get in touch with BUBT IT Club leadership team</p>
            </div>
        </header>

        <!-- Contact Content -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="md:flex md:space-x-8">
                    <div class="md:w-1/2 mb-8 md:mb-0">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Send Us a Message</h2>

                        <form class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full
                                    Name</label>
                                <input type="text" id="name" name="name"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email
                                    Address</label>
                                <input type="email" id="email" name="email"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label for="subject"
                                    class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                                <input type="text" id="subject" name="subject"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label for="message"
                                    class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                                <textarea id="message" name="message" rows="4"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>

                            <div>
                                <button type="submit"
                                    class="px-6 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition duration-300">
                                    Send Message
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="md:w-1/2">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Contact Information</h2>

                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 text-blue-600">
                                    <i class="fas fa-map-marker-alt text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-gray-900">Our Location</h3>
                                    <p class="text-gray-600">BUBT IT Club, Bangladesh University of Business and
                                        Technology, Rupnagar, Mirpur-2, Dhaka-1216</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 text-blue-600">
                                    <i class="fas fa-envelope text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-gray-900">Email Us</h3>
                                    <p class="text-gray-600">itclub@bubt.edu.bd</p>
                                    <p class="text-gray-600">info@bubtitclub.org</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 text-blue-600">
                                    <i class="fas fa-phone-alt text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-gray-900">Call Us</h3>
                                    <p class="text-gray-600">+880 123 456 789</p>
                                    <p class="text-gray-600">+880 987 654 321</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 text-blue-600">
                                    <i class="fas fa-clock text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-gray-900">Office Hours</h3>
                                    <p class="text-gray-600">Sunday to Thursday: 9:00 AM - 5:00 PM</p>
                                    <p class="text-gray-600">Friday & Saturday: Closed</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Follow Us</h3>
                            <div class="flex space-x-4">
                                <a href="#" class="text-gray-600 hover:text-blue-600">
                                    <i class="fab fa-facebook-f text-2xl"></i>
                                </a>
                                <a href="#" class="text-gray-600 hover:text-blue-600">
                                    <i class="fab fa-twitter text-2xl"></i>
                                </a>
                                <a href="#" class="text-gray-600 hover:text-blue-600">
                                    <i class="fab fa-linkedin-in text-2xl"></i>
                                </a>
                                <a href="#" class="text-gray-600 hover:text-blue-600">
                                    <i class="fab fa-github text-2xl"></i>
                                </a>
                                <a href="#" class="text-gray-600 hover:text-blue-600">
                                    <i class="fab fa-youtube text-2xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section -->
        <section class="bg-gray-50 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="rounded-lg overflow-hidden shadow-lg">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.835437398098!2d90.40626631543193!3d23.7908683932264!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7a0f70e53a1%3A0x97856381e88fb311!2sBangladesh%20University%20of%20Business%20and%20Technology%20(BUBT)!5e0!3m2!1sen!2sbd!4v1620000000000!5m2!1sen!2sbd"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>