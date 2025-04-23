{{-- Chart for Avaliablity Placement --}}
<div x-data="{ openFilter: false }" class="container mx-auto p-4 bg-gray-500 dark:bg-gray-500 dark:bg-gray-800 rounded-xl shadow-md p-5 w-full min-h-96">
    {{-- <div class="bg-gradient-to-r from-gray-600 to-gray-500 dark:bg-gray-800 rounded-xl shadow-md p-5 w-full min-h-96"> --}}
    <div class="shadow-md p-6">
    <div>
        <label class="block mb-2 font-medium text-sm text-white">Filter City:</label>
        <select wire:model="chartFilter" class="rounded border-gray-300 mb-4 ">
            <option value="all">All Cities</option>
            @foreach(\App\Models\MediaStatistic::where('user_id', auth()->id())->select('city')->distinct()->pluck('city') as $city)
            <option value="{{ $city }}">{{ $city }}</option>
            @endforeach
        </select>
        <canvas id="adPerformanceChart" class="w-full max-h-[300px] "></canvas>
        @push('scripts')
        @vite('resources/js/adPerformance.js')
    <script>
                document.addEventListener('DOMContentLoaded', () => {
                    initAdChart(@json($this->chartData));
                });

                Livewire.on('refreshChart', data => {
                    renderAdPerformanceChart('adPerformanceChart', data);
                });
            </script>
        @endpush
    </div>
</div>
</div>
</div>
