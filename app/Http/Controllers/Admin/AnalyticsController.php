<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnalyticsVisit;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        $today = now()->startOfDay();
        $sevenDaysAgo = now()->subDays(6)->startOfDay();
        $thirtyDaysAgo = now()->subDays(29)->startOfDay();

        $summary = [
            'today' => AnalyticsVisit::where('visited_at', '>=', $today)->count(),
            'last_7_days' => AnalyticsVisit::where('visited_at', '>=', $sevenDaysAgo)->count(),
            'last_30_days' => AnalyticsVisit::where('visited_at', '>=', $thirtyDaysAgo)->count(),
            'unique_30_days' => AnalyticsVisit::where('visited_at', '>=', $thirtyDaysAgo)->distinct('ip_hash')->count('ip_hash'),
        ];

        $dailyRows = AnalyticsVisit::selectRaw('DATE(visited_at) as visit_date, COUNT(*) as total')
            ->where('visited_at', '>=', $thirtyDaysAgo)
            ->groupBy(DB::raw('DATE(visited_at)'))
            ->orderBy('visit_date')
            ->get()
            ->keyBy('visit_date');

        $dailyVisits = collect(range(29, 0))->map(function ($daysAgo) use ($dailyRows) {
            $date = now()->subDays($daysAgo)->toDateString();

            return [
                'date' => Carbon::parse($date),
                'total' => (int) ($dailyRows[$date]->total ?? 0),
            ];
        });

        $maxDaily = max(1, $dailyVisits->max('total'));

        $topPages = AnalyticsVisit::select('path', DB::raw('COUNT(*) as total'))
            ->where('visited_at', '>=', $thirtyDaysAgo)
            ->groupBy('path')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        $devices = AnalyticsVisit::select('device', DB::raw('COUNT(*) as total'))
            ->where('visited_at', '>=', $thirtyDaysAgo)
            ->groupBy('device')
            ->orderByDesc('total')
            ->get();

        $sources = AnalyticsVisit::select('utm_source', DB::raw('COUNT(*) as total'))
            ->where('visited_at', '>=', $thirtyDaysAgo)
            ->whereNotNull('utm_source')
            ->groupBy('utm_source')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        $recentVisits = AnalyticsVisit::latest('visited_at')->paginate(15);

        return view('analytics.index', compact(
            'summary',
            'dailyVisits',
            'maxDaily',
            'topPages',
            'devices',
            'sources',
            'recentVisits',
        ));
    }
}
