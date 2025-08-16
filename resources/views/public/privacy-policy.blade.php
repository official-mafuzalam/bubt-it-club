<x-app-layout>
    <x-slot name="main">
        <!-- Hero Section -->
        <header class="pt-24 pb-12 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold leading-tight mb-4">Privacy Policy</h1>
                <p class="text-xl mb-8">Last Updated: {{ date('F j, Y') }}</p>
            </div>
        </header>

        <!-- Content Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="prose max-w-none">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">1. Introduction</h2>
                    <p class="text-lg text-gray-600 mb-8">
                        BUBT IT Club ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy
                        explains how we collect, use, disclose, and safeguard your information when you visit our
                        website or participate in our activities.
                    </p>

                    <h2 class="text-2xl font-bold text-gray-900 mb-6">2. Information We Collect</h2>
                    <p class="text-lg text-gray-600 mb-4">
                        We may collect personal information that you voluntarily provide to us, including:
                    </p>
                    <ul class="list-disc pl-6 mb-8 text-gray-600">
                        <li>Name and contact information (email, phone number)</li>
                        <li>University information (student ID, department, batch)</li>
                        <li>Event registration details</li>
                        <li>Payment information for events (processed securely through third-party providers)</li>
                    </ul>

                    <h2 class="text-2xl font-bold text-gray-900 mb-6">3. How We Use Your Information</h2>
                    <p class="text-lg text-gray-600 mb-4">
                        We use the information we collect for various purposes:
                    </p>
                    <ul class="list-disc pl-6 mb-8 text-gray-600">
                        <li>To organize and manage club activities</li>
                        <li>To communicate with members about events and opportunities</li>
                        <li>To improve our services and website</li>
                        <li>To comply with legal obligations</li>
                    </ul>

                    <h2 class="text-2xl font-bold text-gray-900 mb-6">4. Data Security</h2>
                    <p class="text-lg text-gray-600 mb-8">
                        We implement appropriate technical and organizational measures to protect your personal
                        information. However, no method of transmission over the Internet is 100% secure, and we cannot
                        guarantee absolute security.
                    </p>

                    <h2 class="text-2xl font-bold text-gray-900 mb-6">5. Changes to This Policy</h2>
                    <p class="text-lg text-gray-600 mb-8">
                        We may update this Privacy Policy from time to time. We will notify you of any changes by
                        posting the new Privacy Policy on this page and updating the "Last Updated" date.
                    </p>

                    <div class="bg-blue-50 p-6 rounded-lg border-l-4 border-blue-600">
                        <h4 class="text-xl font-semibold text-blue-800 mb-3">Contact Us</h4>
                        <p class="text-gray-700">If you have any questions about this Privacy Policy, please contact us
                            at itclub@bubt.edu.bd</p>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>