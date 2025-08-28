@if($announcement && $announcement['status'])
    <div id="announcement-modal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden transition-opacity duration-300">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-3xl w-full p-6 relative transform scale-95 opacity-0 transition-all duration-300 ease-out">

            <!-- Close Button -->
            <button id="announcement-close"
                class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-bold text-lg shadow-md">
                &times;
            </button>

            <!-- Image -->
            @if(!empty($announcement['image']))
                <img src="{{ asset('storage/' . $announcement['image']) }}"
                    class="w-full max-h-96 object-cover rounded-xl mb-6 shadow-sm" alt="Announcement">
            @endif

            <!-- Title -->
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ $announcement['title'] }}</h2>

            <!-- Message -->
            <div class="text-gray-700 dark:text-gray-300 mb-4 max-h-96 overflow-y-auto">
                {!! nl2br(e($announcement['message'])) !!}
            </div>

            <!-- Target URL -->
            @if(!empty($announcement['target_url']))
                <a href="{{ $announcement['target_url'] }}" target="_blank"
                    class="inline-block mt-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-300 shadow-md">
                    Learn More
                </a>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('announcement-modal');
            const closeBtn = document.getElementById('announcement-close');

            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.firstElementChild.classList.remove('scale-95', 'opacity-0');
                modal.firstElementChild.classList.add('scale-100', 'opacity-100');
            }, 50);

            closeBtn.addEventListener('click', function () {
                modal.firstElementChild.classList.add('scale-95', 'opacity-0');
                setTimeout(() => modal.classList.add('hidden'), 300);
            });

            modal.addEventListener('click', function (e) {
                if(e.target === modal){
                    modal.firstElementChild.classList.add('scale-95', 'opacity-0');
                    setTimeout(() => modal.classList.add('hidden'), 300);
                }
            });
        });
    </script>
@endif
