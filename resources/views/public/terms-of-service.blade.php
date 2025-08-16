<x-app-layout>
    <x-slot name="main">
        <!-- Hero Section -->
        <header class="pt-24 pb-12 bg-gradient-to-r from-blue-800 to-blue-600 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold leading-tight mb-4">Terms of Service</h1>
                <p class="text-xl mb-8">Last Updated: {{ date('F j, Y') }}</p>
            </div>
        </header>

        <!-- Content Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="prose max-w-none">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">1. Acceptance of Terms</h2>
                    <p class="text-lg text-gray-600 mb-8">
                        By accessing or using the BUBT IT Club website and services, you agree to be bound by these
                        Terms of Service. If you do not agree, please do not use our services.
                    </p>

                    <h2 class="text-2xl font-bold text-gray-900 mb-6">2. Membership</h2>
                    <p class="text-lg text-gray-600 mb-4">
                        Membership in BUBT IT Club is open to all current students of Bangladesh University of Business
                        and Technology. Members agree to:
                    </p>
                    <ul class="list-disc pl-6 mb-8 text-gray-600">
                        <li>Abide by the club's constitution and policies</li>
                        <li>Participate in good faith</li>
                        <li>Respect other members and maintain a positive environment</li>
                    </ul>

                    <h2 class="text-2xl font-bold text-gray-900 mb-6">3. Code of Conduct</h2>
                    <p class="text-lg text-gray-600 mb-4">
                        All members and participants in BUBT IT Club activities must adhere to the following:
                    </p>
                    <ul class="list-disc pl-6 mb-8 text-gray-600">
                        <li>Treat all members with respect and professionalism</li>
                        <li>Maintain academic integrity in all activities</li>
                        <li>Not engage in harassment, discrimination, or any unlawful behavior</li>
                        <li>Respect university property and facilities</li>
                    </ul>

                    <h2 class="text-2xl font-bold text-gray-900 mb-6">4. Intellectual Property</h2>
                    <p class="text-lg text-gray-600 mb-8">
                        Content created by the club remains the property of BUBT IT Club unless otherwise stated.
                        Members retain ownership of their individual projects but grant the club rights to showcase
                        their work for promotional purposes.
                    </p>

                    <h2 class="text-2xl font-bold text-gray-900 mb-6">5. Liability</h2>
                    <p class="text-lg text-gray-600 mb-8">
                        BUBT IT Club is not liable for any damages or injuries that may occur during club activities.
                        Members participate at their own risk and are responsible for their personal belongings.
                    </p>

                    <h2 class="text-2xl font-bold text-gray-900 mb-6">6. Amendments</h2>
                    <p class="text-lg text-gray-600 mb-8">
                        These Terms may be amended at any time. Continued use of our services after changes constitutes
                        acceptance of the new terms.
                    </p>

                    <div class="bg-blue-50 p-6 rounded-lg border-l-4 border-blue-600">
                        <h4 class="text-xl font-semibold text-blue-800 mb-3">Contact Information</h4>
                        <p class="text-gray-700">For questions about these Terms of Service, please contact:
                            itclub@bubt.edu.bd</p>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>