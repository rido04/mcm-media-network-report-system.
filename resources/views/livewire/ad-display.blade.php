<div
    x-data="{
        shown: false,
        swiperInstance: null,
        init() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    this.shown = entry.isIntersecting;
                    if (entry.isIntersecting) {
                        observer.unobserve(this.$el);
                        // Initialize Swiper after the element is visible
                        this.$nextTick(() => {
                            this.swiperInstance = new Swiper('.swiper-container', {
                                slidesPerView: 1,
                                spaceBetween: 20,
                                loop: true,
                                autoplay: {
                                    delay: 5000,
                                    disableOnInteraction: false,
                                },
                                pagination: {
                                    el: '.swiper-pagination',
                                    clickable: true,
                                },
                                navigation: {
                                    nextEl: '.swiper-button-next',
                                    prevEl: '.swiper-button-prev',
                                },
                                breakpoints: {
                                    // when window width is >= 640px
                                    640: {
                                        slidesPerView: 1
                                    },
                                    // when window width is >= 768px
                                    768: {
                                        slidesPerView: 1
                                    },
                                    // when window width is >= 1024px
                                    1024: {
                                        slidesPerView: 2
                                    }
                                }
                            });
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
    <!-- Link CSS Swiper -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.css">
    
    <style>
        /* Pastikan container tidak overflow */
        .swiper-container {
            width: 100%;
            overflow: hidden;
            position: relative;
        }
        
        /* Pastikan slide mengikuti lebar parent */
        .swiper-slide {
            width: 100%;
            max-width: 100%;
        }
        
        /* Membuat tombol navigasi lebih sesuai */
        .swiper-button-next,
        .swiper-button-prev {
            color: #ffffff;
            background: rgba(0, 0, 0, 0.3);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 18px;
        }
    </style>
    
    <div class="swiper-container w-full">
        <div class="swiper-wrapper">
            @foreach ($records as $record)
                <div class="swiper-slide">
                    <div class="bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800 rounded-2xl shadow-md overflow-hidden flex flex-col transition-all duration-300 hover:shadow-xl hover:-translate-y-1 h-full">
                        <!-- Image section -->
                        <div class="w-full h-48 bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800 flex justify-center items-center">
                            <img src="{{ Storage::url($record->image_path) }}"
                                alt="{{ $record->title }}"
                                class="object-cover w-full h-full" />
                        </div>

                        <!-- Content section -->
                        <div class="p-6 flex flex-col flex-1 text-white">
                            <div class="flex-grow">
                                <h4 class="text-xl font-semibold mb-2 leading-tight line-clamp-2">
                                    {{ $record->title }}
                                </h4>
                                <p class="text-sm text-gray-300 mb-4 line-clamp-3">
                                    {{ $record->description }}
                                </p>
                            </div>

                            <!-- Footer -->
                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-700">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-600/10 text-blue-400">
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
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <!-- Swiper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
</div>