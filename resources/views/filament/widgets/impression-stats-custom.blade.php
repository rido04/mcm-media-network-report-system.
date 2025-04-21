@php
    use App\Models\DailyImpression;
    use App\Models\MediaStatistic;
    use Illuminate\Support\Facades\Auth;
    use Carbon\Carbon;

    $userId = Auth::id();
    $filters = request()->only(['start_date', 'end_date', 'media_statistic_id']);
    $range = request()->get('range', 'daily');

    $query = DailyImpression::query()
        ->whereHas('adminTraffic', fn ($q) => $q->where('user_id', $userId))
        ->with('mediaStatistic');

    // Date range filter
    if (!empty($filters['start_date'])) {
        $query->whereDate('date', '>=', $filters['start_date']);
    }

    if (!empty($filters['end_date'])) {
        $query->whereDate('date', '<=', $filters['end_date']);
    }

    // Media statistic filter
    if (!empty($filters['media_statistic_id']) && $filters['media_statistic_id'] !== 'all') {
        $query->where('media_statistic_id', $filters['media_statistic_id']);
    }

    // Time range filter
    $today = Carbon::today();
    match ($range) {
        'daily' => $query->whereDate('date', $today),
        'weekly' => $query->whereBetween('date', [
            $today->copy()->startOfWeek(), 
            $today->copy()->endOfWeek()
        ]),
        'monthly' => $query->whereMonth('date', $today->month)
                          ->whereYear('date', $today->year),
        default => null,
    };

    $results = $query->get();
    
    // Handle empty results
    $max = $results->isNotEmpty() ? number_format($results->max('impression')) : 0;
    $min = $results->isNotEmpty() ? number_format($results->min('impression')) : 0;
    $avg = $results->isNotEmpty() ? number_format($results->avg('impression'), 2) : 0;
    $sum = $results->isNotEmpty() ? number_format($results->sum('impression')) : 0;

    // Get cities for filter dropdown
    $cities = MediaStatistic::where('user_id', $userId)
        ->pluck('city', 'id')
        ->prepend('All Cities', 'all');
@endphp

<div class="space-y-4">
    <!-- Filter Controls -->
    <div class="flex flex-wrap items-center justify-between gap-4 p-4 bg-gray-500 rounded-lg shadow">
        <!-- Time Range Buttons -->
        <div class="flex space-x-2">
            @foreach (['daily' => 'Daily', 'weekly' => 'Weekly', 'monthly' => 'Monthly'] as $value => $label)
                <a href="?{{ http_build_query(array_merge(request()->query(), ['range' => $value])) }}"
                   class="px-3 py-1 rounded-full border text-sm font-medium transition-colors
                          {{ $range === $value ? 'bg-primary-600 text-white' : 'bg-gray-500 text-gray-800 hover:bg-gray-700' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <!-- Additional Filters -->
        <div class="flex flex-wrap items-center gap-4">
            <!-- City Filter -->
            <select name="media_statistic_id" 
                    class="rounded-md border-gray-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                    onchange="this.form.submit()">
                @foreach($cities as $id => $city)
                    <option value="{{ $id }}" {{ ($filters['media_statistic_id'] ?? '') == $id ? 'selected' : '' }}>
                        {{ $city }}
                    </option>
                @endforeach
            </select>

            <!-- Date Range Filter -->
            <div class="flex items-center space-x-2">
                <input type="date" name="start_date" value="{{ $filters['start_date'] ?? '' }}"
                       class="rounded-md border-gray-500 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                       onchange="this.form.submit()">
                <span>to</span>
                <input type="date" name="end_date" value="{{ $filters['end_date'] ?? '' }}"
                       class="rounded-md border-gray-500 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                       onchange="this.form.submit()">
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-stat-card label="Highest Impression" :value="$max" color="green" />
        <x-stat-card label="Lowest Impression" :value="$min" color="red" />
        <x-stat-card label="Average Impression" :value="$avg" color="blue" />
        <x-stat-card label="Total Impression" :value="$sum" color="indigo" />
    </div>
</div>

<form method="GET" action="" class="hidden">
    @foreach(request()->except(['start_date', 'end_date', 'media_statistic_id', 'range']) as $key => $value)
        {{-- <input type="hidden" name="{{ $key }}" value="{{ $value }}"> --}}
    @endforeach
</form>

<script>
    // Submit form when filters change
    document.querySelectorAll('select[name="media_statistic_id"], input[type="date"]').forEach(el => {
        el.addEventListener('change', function() {
            this.closest('form').submit();
        });
    });
</script>