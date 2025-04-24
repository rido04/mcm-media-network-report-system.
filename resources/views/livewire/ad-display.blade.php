<div>

    <div class="flex flex-col space-y-6">
        @foreach ($records as $record)
            <div class="bg-gray-600  rounded-xl shadow-lg overflow-hidden flex flex-col sm:flex-row transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <!-- Image section -->
                <div class="w-full sm:w-1/3 bg-black flex justify-center items-center">
                    <img src="{{ Storage::url($record->image_path) }}"
                         alt="{{ $record->title }}"
                         class="object-contain w-full max-h-60 bg-gray-300" />
                </div>

                <!-- Content section -->
                <div class="p-5 flex flex-col flex-1">
                    <div class="flex-grow">
                        <h4 class="text-xl font-bold text-white  mb-2 line-clamp-2">
                            {{ $record->title }}
                        </h4>
                        <p class="text-white 300 text-sm mb-4 line-clamp-3">
                            {{ $record->description }}
                        </p>
                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-between mt-auto">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 0 200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $record->start_date->format('M d') }} - {{ $record->end_date->format('M d, Y') }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
