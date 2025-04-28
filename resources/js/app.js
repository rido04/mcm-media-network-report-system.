import "./bootstrap";
// Import Swiper
import Swiper, { Navigation, Pagination } from "swiper";

// Impor style Swiper
import "swiper/swiper-bundle.min.css";

// Kemudian inisialisasi Swiper seperti biasa
document.addEventListener("DOMContentLoaded", () => {
    const swiper = new Swiper(".swiper-container", {
        modules: [Navigation, Pagination],
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
                slidesPerView: 1.5, // 1.5 slide pada resolusi lebih kecil
                centeredSlides: true,
            },
            768: {
                slidesPerView: 2,
                centeredSlides: false,
                spaceBetween: 24, // jarak antar kolom
            },
            1024: {
                slidesPerView: 3, // 3 slide pada resolusi 1024px ke atas
                spaceBetween: 32,
            },
            1280: {
                slidesPerView: 2, // 4 slide pada resolusi 1280px ke atas
                spaceBetween: 32,
            },
        },
    });
});
