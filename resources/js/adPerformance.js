import Chart from "chart.js/auto";

let chartInstance;

window.renderAdPerformanceChart = function (canvasId, data) {
    const ctx = document.getElementById(canvasId).getContext("2d");
    if (chartInstance) chartInstance.destroy();

    chartInstance = new Chart(ctx, {
        type: "bar",
        indexAxis: "y",
        data: {
            labels: data.labels,
            datasets: data.datasets.map((dataset) => ({
                ...dataset,
                barPercentage: 0.6,
                categoryPercentage: 0.6,
                maxBarThickness: 40,
            })),
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: "index",
                intersect: false,
            },
            plugins: {
                legend: {
                    position: "top",
                    labels: {
                        generateLabels: function (chart) {
                            return chart.data.datasets.map((dataset, i) => ({
                                text: dataset.label,
                                fillStyle: dataset.backgroundColor,
                                strokeStyle: dataset.borderColor,
                                lineWidth: 1,
                                hidden: !chart.isDatasetVisible(i),
                                index: i,
                                fontColor: dataset.textColor || "#000",
                            }));
                        },
                    },
                },
                tooltip: {
                    enabled: true,
                    callbacks: {
                        labelColor: function (context) {
                            const color =
                                context.dataset.textColor ||
                                context.dataset.backgroundColor ||
                                "#fff";
                            return {
                                borderColor: color,
                                backgroundColor: color,
                            };
                        },
                        labelTextColor: () => "#fff",
                        label: function (context) {
                            return `${context.dataset.label}: ${context.parsed.x}`;
                        },
                    },
                },
            },
            layout: {
                padding: { left: 10, right: 10, top: 20, bottom: 10 },
            },
            scales: {
                x: {
                    stacked: false,
                    grid: { display: false },
                    ticks: {
                        maxRotation: 45,
                        autoSkip: false,
                        color: "#fff",
                    },
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        color: "#fff",
                    },
                },
            },
        },
    });
};

window.initAdChart = function (data) {
    renderAdPerformanceChart("adPerformanceChart", data);
};
