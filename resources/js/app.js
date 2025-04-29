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

    // Count the number of slides
    const slideCount = container.querySelectorAll(".swiper-slide").length;

    // Base configuration
    const swiperConfig = {
        modules: [Navigation, Pagination, Autoplay],
        slidesPerView: 1,
        spaceBetween: 20,
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
                slidesPerView: slideCount > 1 ? 1.5 : 1, // Adjust for single slide
                centeredSlides: slideCount > 1,
            },
            768: {
                slidesPerView: Math.min(slideCount, 2),
                centeredSlides: slideCount === 1,
                spaceBetween: 24,
            },
            1024: {
                slidesPerView: Math.min(slideCount, 3),
                spaceBetween: 32,
            },
            1280: {
                slidesPerView: Math.min(slideCount, 2),
                spaceBetween: 32,
            },
        },
    };

    // Only enable loop and autoplay if there's more than one slide
    if (slideCount > 1) {
        swiperConfig.loop = true;
        swiperConfig.autoplay = {
            delay: 5000,
            disableOnInteraction: false,
        };
    } else {
        // Hide navigation and pagination for single slide
        const pagination = container.querySelector(".swiper-pagination");
        const nextBtn = container.querySelector(".swiper-button-next");
        const prevBtn = container.querySelector(".swiper-button-prev");

        if (pagination) pagination.style.display = "none";
        if (nextBtn) nextBtn.style.display = "none";
        if (prevBtn) prevBtn.style.display = "none";
    }

    // Initialize new Swiper instance
    new Swiper(container, swiperConfig);
}
