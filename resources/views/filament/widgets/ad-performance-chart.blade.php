<x-filament::card>
    <x-filament::section>
        <h2 class="text-xl font-semibold mb-4">Performance</h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            @foreach (['commuterline', 'transjakarta', 'traffic'] as $category)
                @php
                    $data = $this->getData()[$category] ?? collect([]);
                @endphp

                <div>
                    <h3 class="font-bold text-md mb-2 capitalize">{{ $category }}</h3>
                    <canvas id="chart-{{ $category }}"></canvas>
                </div>

                <script>
                    const data{{ ucfirst($category) }} = {
                        labels: {!! json_encode($data->keys()) !!},
                        datasets: [{
                            label: 'Performance',
                            data: {!! json_encode($data->values()) !!},
                            backgroundColor: 'rgba(59, 130, 246, 0.5)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            fill: true,
                            tension: 0.4,
                        }]
                    };

                    new Chart(document.getElementById('chart-{{ $category }}'), {
                        type: 'line',
                        data: data{{ ucfirst($category) }},
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            @endforeach
        </div>
    </x-filament::section>
</x-filament::card>
