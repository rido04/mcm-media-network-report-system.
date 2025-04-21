<x-filament-widgets::widget>
<div class="w-full space-y-4">
    @foreach($this->getRecords() as $ad)
        <div class="w-full bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <div class="w-full md:w-2/5 lg:w-1/3 p-4">
                    <img src="{{ Storage::url($ad->image_path) }}"
                        alt="{{ $ad->title }}"
                        class="w-ful24l h-24 object-cover rounded-lg shadow-sm"
                        onerror="this.src='{{ asset('images/default-ad.jpg') }}'">
                </div>
                <div class="w-full md:w-3/5 lg:w-2/3 p-4">
                    <div class="h-full flex flex-col justify-between">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2 break-words">
                            {{ strtoupper($ad->title) }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-100 text-sm mb-4 break-words whitespace-pre-line">
                            {{ $ad->description }}
                        </p>
                        <div class="mt-auto">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-100">
                                {{ $ad->start_date->format('d M Y') }} - {{ $ad->end_date->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
</x-filament-widgets::widget>
