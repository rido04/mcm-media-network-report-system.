<div class="transition-all duration-1000 ease-out transform opacity-0 translate-y-4"
     x-data="{
         shown: false,
         init() {
             const observer = new IntersectionObserver((entries) => {
                 entries.forEach(entry => {
                     this.shown = entry.isIntersecting;
                     if (entry.isIntersecting) {
                         observer.unobserve(this.$el);
                         // Add slight delay between items
                         this.$el.querySelectorAll('.record-item').forEach((el, index) => {
                             setTimeout(() => {
                                 el.classList.remove('opacity-0', 'translate-y-4');
                             }, index * 100);
                         });
                     }
                 });
             }, { threshold: 0.1 });
             observer.observe(this.$el);
         }
     }"
     x-bind:class="{
         'opacity-100': shown,
     }">
    <div class="flex flex-col space-y-6">
        @foreach ($records as $record)
            <div class="record-item opacity-0 translate-y-4 transition-all duration-500 ease-out transform bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800 rounded-xl shadow-lg overflow-hidden flex flex-col sm:flex-row hover:shadow-xl hover:-translate-y-1 hover:scale-[1.005] group"
                 style="transition-delay: {{ $loop->index * 100 }}ms">
                <!-- Image section -->
                <div class="w-full sm:w-1/3 bg-black flex justify-center items-center overflow-hidden">
                    <img src="{{ Storage::url($record->image_path) }}"
                         alt="{{ $record->title }}"
                         class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105" />
                </div>

                <!-- Content section -->
                <div class="p-6 flex flex-col flex-1">
                    <div class="flex-grow">
                        <h4 class="text-xl md:text-2xl font-bold text-white mb-3 line-clamp-2 group-hover:text-blue-300 transition-colors duration-300">
                            {{ $record->title }}
                        </h4>
                        <p class="text-gray-300 text-sm md:text-base mb-4 line-clamp-3">
                            {{ $record->description }}
                        </p>
                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-between mt-auto">
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 transition-colors duration-300 group-hover:bg-blue-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $record->start_date->format('M d') }} - {{ $record->end_date->format('M d, Y') }}
                        </span>

                        <!-- Optional: Add a CTA button -->
                        <button class="hidden sm:inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors duration-300">
                            View Details
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
