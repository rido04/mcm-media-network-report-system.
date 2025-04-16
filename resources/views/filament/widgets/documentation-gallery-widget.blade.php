<x-filament::section>
    <x-slot name="heading">Documentation</x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" style="display: grid;">
        @foreach ($docs as $doc)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-200 dark:border-gray-700">
                <!-- Image Container with Hover Effect -->
                <div class="relative h-48 w-full overflow-hidden cursor-pointer hover-container">
                    <img
                        src="{{ asset('storage/' . $doc->image_path) }}"
                        alt="{{ $doc->description }}"
                        class="w-full h-full object-cover transition-transform duration-500 hover-image"
                    >
                    <!-- Dark overlay - only visible on hover -->
                    <div class="absolute inset-0 bg-black opacity-0 transition-opacity duration-300 hover-overlay"></div>

                    <!-- Description - only appears on hover -->
                    <div class="absolute inset-0 flex flex-col justify-center p-4 opacity-0 transition-opacity duration-300 hover-content">
                        <h3 class="font-bold text-white text-lg mb-2">
                            {{ basename($doc->image_path) }}
                        </h3>
                        <p class="text-gray-200 text-sm">
                            {{ $doc->description }}
                        </p>

                        <!-- Action Buttons -->
                        <div class="flex justify-center mt-4 space-x-3">
                            <button class="p-2 bg-indigo-500 rounded-full text-white hover:bg-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button class="p-2 bg-indigo-500 rounded-full text-white hover:bg-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Additional Info (visible always) -->
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            {{ $doc->created_at->format('d M Y') }}
                        </span>
                        <span class="px-2 py-1 text-xs rounded-full bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200">
                            {{ strtoupper(pathinfo($doc->image_path, PATHINFO_EXTENSION)) }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <style>
        .hover-container:hover .hover-image {
            transform: scale(1.05);
        }
        .hover-container:hover .hover-overlay {
            opacity: 0.6;
        }
        .hover-container:hover .hover-content {
            opacity: 1;
        }
    </style>
</x-filament::section>
