import "./bootstrap";
import ApexCharts from "apexcharts";
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

// Total Performance with Apex Chart
window.initPerformanceChart = function (
    labels,
    datasets,
    chartId = "performanceChart"
) {
    // Check if element exists
    const chartElement = document.getElementById(chartId);
    if (!chartElement) {
        console.error(`Element with ID ${chartId} not found`);
        return null;
    }

    const series = [];
    const categories = labels;

    // Convert datasets to area series
    datasets.forEach((dataset) => {
        series.push({
            name: dataset.label,
            type: "area",
            data: dataset.data,
            color: dataset.backgroundColor,
        });
    });

    // Add trend line if there's data
    if (datasets.length > 0 && datasets[0].data) {
        const trendLineData = datasets[0].data.map((value) => {
            const multiplier = Math.random() * 0.1 + 1.15;
            return Math.round(value * multiplier);
        });

        series.push({
            name: "Trend Line",
            type: "line",
            data: trendLineData,
            color: "#FF6384",
            stroke: {
                width: 2,
                curve: "smooth",
            },
            fill: {
                type: "solid",
                opacity: 0,
            },
        });
    }

    const options = {
        series: series,
        chart: {
            type: "area",
            height: "100%",
            stacked: false,
            toolbar: {
                show: false,
            },
            zoom: {
                enabled: false,
            },
            animations: {
                enabled: true,
                easing: "easeinout",
                speed: 1000,
            },
            background: "transparent",
        },
        dataLabels: {
            enabled: false, // Changed from true to false (less clutter)
        },
        stroke: {
            curve: "smooth",
            width: 2,
            dashArray: [0, 0, 5],
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.3,
                stops: [0, 90, 100],
            },
        },
        xaxis: {
            categories: categories,
            labels: {
                style: {
                    colors: "#FFFFFF",
                    fontSize: "11px",
                    fontFamily: "'Inter', sans-serif",
                },
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        yaxis: {
            min: 0,
            labels: {
                style: {
                    colors: "#FFFFFF",
                    fontSize: "11px",
                    fontFamily: "'Inter', sans-serif",
                },
            },
            grid: {
                borderColor: "rgba(255, 255, 255, 0.05)",
                strokeDashArray: 4,
            },
        },
        legend: {
            position: "bottom",
            labels: {
                colors: "#FFFFFF",
                useSeriesColors: false,
                fontSize: "12px",
                fontFamily: "'Inter', sans-serif",
            },
            markers: {
                width: 12,
                height: 12,
                radius: 6,
            },
        },
        tooltip: {
            shared: true,
            intersect: false,
            theme: "dark",
            style: {
                fontSize: "12px",
                fontFamily: "'Inter', sans-serif",
            },
        },
        grid: {
            borderColor: "rgba(255, 255, 255, 0.05)",
            strokeDashArray: 4,
            padding: {
                top: 0,
                right: 10,
                bottom: 0,
                left: 10,
            },
        },
    };

    // Destroy previous chart instance if exists
    if (chartElement._apexChart) {
        chartElement._apexChart.destroy();
    }

    const chart = new ApexCharts(chartElement, options);
    chart.render();

    // Store reference on element
    chartElement._apexChart = chart;

    return chart;
};
