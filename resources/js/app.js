import "./bootstrap";
import ApexCharts from "apexcharts";
import { Grid } from "gridjs";
import "gridjs/dist/theme/mermaid.css";
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
            enabled: false,
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

// Initialize components when the DOM is fully loaded
document.addEventListener("DOMContentLoaded", function () {
    // Initialize the welcome animation
    initWelcomeAnimation();

    // Initialize floating assistant
    initFloatingAssistant();

    // Initialize the performance chart if we're on the profile page
    if (document.getElementById("performanceChart") && window.apexChartData) {
        initPerformanceChart(
            window.apexChartData.labels,
            window.apexChartData.datasets
        );
    }
});

// Initialize the Performance Chart
function initPerformanceChart(labels, datasets) {
    // Transform datasets to ApexCharts format
    const series = datasets.map((dataset) => {
        return {
            name: dataset.label,
            data: dataset.data,
            color: dataset.backgroundColor,
        };
    });

    const options = {
        series: series,
        chart: {
            type: "area",
            height: 320,
            fontFamily: "Inter, system-ui, sans-serif",
            toolbar: {
                show: false,
            },
            zoom: {
                enabled: false,
            },
            foreColor: "#9ca3af", // text color
            background: "transparent",
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "smooth",
            width: 2,
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.3,
                opacityTo: 0.1,
                stops: [0, 90, 100],
            },
        },
        legend: {
            position: "top",
            horizontalAlign: "left",
            offsetY: -20,
            itemMargin: {
                horizontal: 10,
                vertical: 5,
            },
            labels: {
                colors: "#f3f4f6", // Light gray text for legend
            },
        },
        xaxis: {
            categories: labels,
            labels: {
                style: {
                    colors: "#9ca3af", // Text color for x-axis labels
                },
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
            tooltip: {
                enabled: false,
            },
        },
        yaxis: {
            labels: {
                formatter: function (val) {
                    return val.toFixed(0);
                },
                style: {
                    colors: "#9ca3af", // Text color for y-axis labels
                },
            },
        },
        tooltip: {
            theme: "dark",
            y: {
                formatter: function (val) {
                    return val.toFixed(0) + " impressions";
                },
            },
        },
        grid: {
            borderColor: "rgba(107, 114, 128, 0.2)", // Gray-500 with opacity
            strokeDashArray: 5,
            position: "back",
        },
    };

    // Initialize the chart
    const chart = new ApexCharts(
        document.querySelector("#performanceChart"),
        options
    );
    chart.render();

    // Update the chart on window resize for responsiveness
    window.addEventListener("resize", function () {
        chart.updateOptions({
            chart: {
                height:
                    document.querySelector(".chart-container").offsetHeight -
                    80,
            },
        });
    });

    // Handle Livewire updates
    document.addEventListener("livewire:update", function () {
        if (window.apexChartData) {
            chart.updateOptions({
                xaxis: {
                    categories: window.apexChartData.labels,
                },
            });

            chart.updateSeries(
                window.apexChartData.datasets.map((dataset) => {
                    return {
                        name: dataset.label,
                        data: dataset.data,
                    };
                })
            );
        }
    });
}

// Initialize the Welcome Animation
function initWelcomeAnimation() {
    const welcomeContainer = document.getElementById("welcome-animation");
    if (!welcomeContainer) return;

    const fallback = document.getElementById("animation-fallback");
    const userName =
        welcomeContainer
            .querySelector("h2")
            .textContent.split(",")[1]
            ?.trim() || "User";

    try {
        const anim = lottie.loadAnimation({
            container: document.getElementById("lottie-welcome"),
            renderer: "svg",
            loop: false,
            autoplay: true,
            path: "/animations/welcome_animation.json",
            rendererSettings: {
                preserveAspectRatio: "xMidYMid slice",
            },
        });

        anim.addEventListener("DOMLoaded", () => {
            if (fallback) fallback.style.display = "none";
        });

        anim.addEventListener("data_failed", () => {
            showFallbackAnimation(fallback, userName);
        });
    } catch (e) {
        console.error("Lottie animation failed to load:", e);
        showFallbackAnimation(fallback, userName);
    }

    setTimeout(() => {
        welcomeContainer.style.opacity = "0";
        setTimeout(() => {
            welcomeContainer.style.display = "none";
        }, 500);
    }, 3000);
}

// Show fallback animation when Lottie fails
function showFallbackAnimation(fallbackElement, userName) {
    if (!fallbackElement) return;

    fallbackElement.innerHTML = `
        <div class="animate-bounce">
            <i class="fas fa-hand-peace text-5xl sm:text-6xl text-blue-500 mb-4"></i>
            <p class="text-gray-600 text-lg sm:text-xl">Welcome ${userName}!</p>
        </div>
    `;
    fallbackElement.style.display = "block";
}

// Initialize the Floating Assistant
function initFloatingAssistant() {
    const assistantElement = document.getElementById("floating-assistant");
    if (!assistantElement) return;

    try {
        const assistant = lottie.loadAnimation({
            container: assistantElement,
            renderer: "svg",
            loop: true,
            autoplay: true,
            path: "/animations/stats.json",
            rendererSettings: {
                preserveAspectRatio: "xMidYMid slice",
            },
        });

        assistantElement.addEventListener("click", function () {
            assistant.playSegments([0, 30], true);
            setTimeout(() => {
                const helpOptions = confirm(
                    "Need help?\n\nOK: Contact Support\nCancel: View Tutorial"
                );
                if (helpOptions) {
                    window.location.href = "/contact";
                } else {
                    window.open("/tutorial", "_blank");
                }
            }, 500);
        });
    } catch (e) {
        console.error("Assistant animation failed to load:", e);
        assistantElement.innerHTML = `
            <div class="w-full h-full bg-blue-500 rounded-full flex items-center justify-center shadow-lg">
                <i class="fas fa-question text-white text-2xl sm:text-3xl"></i>
            </div>
        `;
    }
}




