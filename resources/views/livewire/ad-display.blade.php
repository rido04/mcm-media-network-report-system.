<div
    x-data="{
        shown: false,
        singleRecord: {{ count($records) === 1 ? 'true' : 'false' }},
        init() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    this.shown = entry.isIntersecting;
                    if (entry.isIntersecting) {
                        observer.unobserve(this.$el);
                        this.$nextTick(() => {
                            if (!this.singleRecord) {
                                const event = new CustomEvent('initSwiper', {
                                    detail: { container: this.$el.querySelector('.swiper-container') }
                                });
                                document.dispatchEvent(event);
                            }
                        });
                    }
                });
            });
            observer.observe(this.$el);
        }
    }"
    x-bind:class="{
        'opacity-100 translate-y-0': shown,
        'opacity-0 translate-y-4': !shown
    }"
    class="transition-all duration-1000 ease-out transform opacity-0 translate-y-4 w-full"
>
    <!-- Conditional rendering based on number of records -->
    <template x-if="!singleRecord">
        <!-- Multiple records - Use Swiper -->
        <div class="swiper-container w-full">
            <div class="swiper-wrapper">
                @foreach ($records as $record)
                    <div class="swiper-slide">
                        <div class="bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800 rounded-2xl shadow-lg overflow-hidden flex flex-col transition-all duration-300 hover:shadow-xl hover:-translate-y-1 h-full border border-gray-700">
                            <!-- Image section with overlay gradient -->
                            <div class="relative w-full h-52 overflow-hidden">
                                <img src="{{ Storage::url($record->image_path) }}"
                                    alt="{{ $record->title }}"
                                    class="object-cover w-full h-full transition-transform duration-500 hover:scale-105" />
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-60"></div>
                            </div>

                            <!-- Content section -->
                            <div class="p-6 flex flex-col flex-1 text-white">
                                <div class="flex-grow">
                                    <h4 class="text-xl font-semibold mb-2 leading-tight line-clamp-2 text-blue-200">
                                        {{ $record->title }}
                                    </h4>

                                    <!-- Enhanced description with read more -->
                                    <div x-data="{ expanded: false }">
                                        <p class="text-sm text-gray-300 mb-2"
                                           :class="expanded ? '' : 'line-clamp-3'">
                                            {{ $record->description }}
                                        </p>
                                        @if(strlen($record->description) > 120)
                                        <button @click="expanded = !expanded"
                                                class="text-blue-400 hover:text-blue-300 text-xs font-medium focus:outline-none transition">
                                            <span x-text="expanded ? 'Show Less' : 'Read More'"></span>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="h-3 w-3 inline ml-1 transition-transform duration-200"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor"
                                                 :class="{'rotate-180': expanded}">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                        @endif
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-600">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-600/20 text-blue-300 backdrop-blur-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $record->start_date->format('M d') }} - {{ $record->end_date->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Add Pagination -->
            <div class="swiper-pagination mt-4"></div>

            <!-- Add Navigation -->
            <div class="swiper-button-next text-white"></div>
            <div class="swiper-button-prev text-white"></div>
        </div>
    </template>

    <template x-if="singleRecord">
        <!-- Single record - Use Flexbox layout -->
        @if(count($records) === 1)
            @php $record = $records->first(); @endphp
            <div class="bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border border-gray-700">
                <!-- Flexbox container -->
                <div class="flex flex-col md:flex-row">
                    <!-- Image section (left on md+ screens) -->
                    <div class="relative w-full md:w-2/5 h-64 md:h-auto overflow-hidden">
                        <img src="{{ Storage::url($record->image_path) }}"
                            alt="{{ $record->title }}"
                            class="object-cover w-full h-full md:h-full transition-transform duration-500 hover:scale-105" />
                        <div class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-gray-900 via-transparent to-transparent opacity-60"></div>
                    </div>

                    <!-- Content section (right on md+ screens) -->
                    <div class="p-6 md:p-8 flex flex-col flex-1 text-white">
                        <div class="flex-grow">
                            <h4 class="text-2xl font-bold mb-3 leading-tight text-blue-200">
                                {{ $record->title }}
                            </h4>

                            <!-- Full text display for single record -->
                            <p class="text-base text-gray-300 mb-6 leading-relaxed">
                                {{ $record->description }}
                            </p>
                        </div>

                        <!-- Footer -->
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-600">
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-blue-600/20 text-blue-300 backdrop-blur-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $record->start_date->format('M d') }} - {{ $record->end_date->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </template>
</div>
