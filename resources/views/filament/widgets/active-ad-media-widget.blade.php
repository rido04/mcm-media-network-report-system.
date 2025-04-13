<div class="w-full space-y-4">
    @foreach($this->getRecords() as $ad)
        <div class="w-full bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <!-- Image Section (30% width) -->
                <div class="w-full md:w-2/5 lg:w-1/3 p-4">
                    <img src="{{ Storage::url($ad->image_path) }}"
                         alt="{{ $ad->media_plan }}"
                         class="w-full h-48 object-cover rounded-lg shadow-sm"
                         onerror="this.src='{{ asset('images/default-ad.jpg') }}'">
                </div>

                <!-- Content Section (70% width) -->
                <div class="w-full md:w-3/5 lg:w-2/3 p-4">
                    <div class="h-full flex flex-col justify-between">
                        <!-- Header -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2 break-words">
                                {{ strtoupper($ad->media_plan) }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 break-words whitespace-pre-line">
                                {{ $ad->description }}
                            </p>
                        </div>

                        <!-- Footer -->
                        <div class="mt-auto">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-100">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $ad->start_date->format('d M Y') }} - {{ $ad->end_date->format('d M Y') }}
                                </span>

                                @if($ad->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100">
                                        Active
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @if($this->getRecords()->isEmpty())
        <div class="w-full p-8 text-center bg-white dark:bg-gray-800 rounded-lg">
            <p class="text-gray-500 dark:text-gray-400">No active advertisements found</p>
        </div>
    @endif
</div>
