import "./bootstrap";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
// Import Swiper
import Swiper, { Navigation, Pagination, Autoplay } from "swiper";

import "swiper/swiper-bundle.min.css";

document.addEventListener("DOMContentLoaded", () => {
    // Listener for all swiper containers on page load
    const swiperContainers = document.querySelectorAll(".swiper-container");
    swiperContainers.forEach(initSwiperContainer);

    // Custom event listener for lazy-loaded swiper containers (via Alpine.js)
    document.addEventListener("initSwiper", (event) => {
        if (event.detail && event.detail.container) {
            initSwiperContainer(event.detail.container);
        }
    });
});

// Function to initialize a Swiper container
function initSwiperContainer(container) {
    // Check if Swiper has already been initialized on this container
    if (container.swiper instanceof Swiper) {
        return;
    }

    // Initialize new Swiper instance
    new Swiper(container, {
        modules: [Navigation, Pagination, Autoplay],
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 1.5, // 1.5 slide on smaller resolution
                centeredSlides: true,
            },
            768: {
                slidesPerView: 2,
                centeredSlides: false,
                spaceBetween: 24,
            },
            1024: {
                slidesPerView: 3, // 3 slide on 1024px resolution and up
                spaceBetween: 32,
            },
            1280: {
                slidesPerView: 2, // 4 slide on 1280px resolution and up
                spaceBetween: 32,
            },
        },
    });
}
