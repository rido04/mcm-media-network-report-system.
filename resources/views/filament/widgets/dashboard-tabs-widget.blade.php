<x-filament-widgets::widget>
    <div x-data="{ tab: 'media_placement' }" class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
        <!-- Responsive Tab Navigation -->
        <div class="relative mb-6">
            <div class="border-b border-gray-200 dark:border-gray-700 overflow-x-auto">
                <div class="flex space-x-4 min-w-max"> <!-- min-w-max forces horizontal layout -->
                    <button @click="tab = 'media_placement'"
                            :class="tab === 'media_placement' ? 'border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 font-semibold' : 'text-gray-600 dark:text-gray-400'"
                            class="py-2 px-4 focus:outline-none transition-colors whitespace-nowrap">
                        Media Placement
                    </button>
                    <button @click="tab = 'media_statistics'"
                            :class="tab === 'media_statistics' ? 'border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 font-semibold' : 'text-gray-600 dark:text-gray-400'"
                            class="py-2 px-4 focus:outline-none transition-colors whitespace-nowrap">
                        Media Plan
                    </button>
                    <button @click="tab = 'play_log'"
                            :class="tab === 'play_log' ? 'border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 font-semibold' : 'text-gray-600 dark:text-gray-400'"
                            class="py-2 px-4 focus:outline-none transition-colors whitespace-nowrap">
                        Play Log
                    </button>
                    <button @click="tab = 'documentation'"
                            :class="tab === 'documentation' ? 'border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 font-semibold' : 'text-gray-600 dark:text-gray-400'"
                            class="py-2 px-4 focus:outline-none transition-colors whitespace-nowrap">
                        Documentation
                    </button>
                </div>
            </div>
        </div>

    <!-- Media Placement Tab -->
    <div x-show="tab === 'media_placement'" x-cloak>
        <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
            <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black dark:text-white. dark:text-gray-300 uppercase tracking-wider">Media</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black dark:text-white. dark:text-gray-300 uppercase tracking-wider">Category</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black dark:text-white. dark:text-gray-300 uppercase tracking-wider">Space Ads</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black dark:text-white. dark:text-gray-300 uppercase tracking-wider">Size</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black dark:text-white. dark:text-gray-300 uppercase tracking-wider">Avg daily Impression</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($mediaPlacement as $item)
                    <tr class="hover:bg-gray-800 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $item->media ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-white. dark:text-gray-300">{{ $item->adminTraffic->category ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-white. dark:text-gray-300">{{ $item->space_ads ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-white. dark:text-gray-300">{{ $item->size ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-white. dark:text-gray-300">
                            {{ number_format($item->avg_daily_impression, 2) }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-black dark:text-white. dark:text-gray-400">No Media Placement yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Media Plan Tab -->
    <div x-show="tab === 'media_statistics'" x-cloak>
        <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
            <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black dark:text-white. dark:text-gray-300 uppercase tracking-wider">Media Plan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black dark:text-white. dark:text-gray-300 uppercase tracking-wider">Start Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black dark:text-white. dark:text-gray-300 uppercase tracking-wider">End Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black dark:text-white. dark:text-gray-300 uppercase tracking-wider">Remainings</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black dark:text-white. dark:text-gray-300 uppercase tracking-wider">Total Impression</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($mediaStatistics as $item)
                    <tr class="hover:bg-blue-500 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-white. dark:text-gray-300">{{ $item->media }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-white. dark:text-gray-300">{{ $item->start_date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-white. dark:text-gray-300">{{ $item->end_date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-white. dark:text-gray-300">
                            {{ \Carbon\Carbon::parse($item->start_date)->diffInDays($item->end_date) }} days
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-white. dark:text-gray-300">{{ $item->dailyImpressions->sum('impression') ?? '0' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-black dark:text-white. dark:text-gray-400">No Media Plans yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Play Date Tab -->
    <div x-show="tab === 'play_log'" x-cloak>
        <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
            <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black dark:text-white. dark:text-gray-300 uppercase tracking-wider">Device ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black dark:text-white. dark:text-gray-300 uppercase tracking-wider">Media Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black dark:text-white. dark:text-gray-300 uppercase tracking-wider">Play Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black dark:text-white. dark:text-gray-300 uppercase tracking-wider">Longitude</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black dark:text-white. dark:text-gray-300 uppercase tracking-wider">Latitude</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black dark:text-white. dark:text-gray-300 uppercase tracking-wider">Location</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($playLogs as $log)
                    <tr class="hover:bg-blue-500 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $log->device_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-white. dark:text-gray-300">{{ $log->media_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-white. dark:text-gray-300">{{ $log->play_date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-white. dark:text-gray-300">{{ $log->longitude }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-white. dark:text-gray-300">{{ $log->latitude }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-white. dark:text-gray-300">
                            {{ $log->location ?? $log->latitude.', '.$log->longitude }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-sm text-black dark:text-white. dark:text-gray-400">No Play Log yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Documentation Tab -->
    <div x-show="tab === 'documentation'" x-cloak>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($documentations as $doc)
            <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-600 hover:shadow-lg transition-shadow">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset('storage/' . $doc->image_path) }}"
                         alt="{{ $doc->description }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-4">
                    <h4 class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $doc->description }}</h4>
                    <p class="text-xs text-black dark:text-white. dark:text-gray-400 mt-1">Client: {{ $doc->user->name ?? '-' }}</p>
                    <p class="text-xs text-black dark:text-white. dark:text-gray-400 mt-1">Uploaded at: {{ $doc->created_at->format('d M Y') }}</p>
                </div>
            </div>
            @empty
            <div class="col-span-3 py-8 text-center">
                <p class="text-black dark:text-white. dark:text-gray-400">There's no documentation yet.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
</x-filament-widgets::widget>
