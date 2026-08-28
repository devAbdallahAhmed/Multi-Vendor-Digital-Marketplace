<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\AuthorSale;
use App\Models\Item;
use App\Models\KycVerification;
use App\Models\Purchase;
use App\Models\Withdraws;
use App\Models\Newsletter;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->get('year', Carbon::now()->year);

        $monthRange = [];
        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::createFromDate($year, $month, 1);
            $monthRange[$date->format('Y-m')] = [
                'month_name' => $date->format('F'),
                'year' => $year,
                'month' => $month,
                'total_sales' => 0,
                'total_author_earnings' => 0,
                'platform_revenue' => 0,
            ];
        }

        $startDate = Carbon::createFromDate($year, 1, 1)->startOfDay();
        $endDate = Carbon::createFromDate($year, 12, 31)->endOfDay();

        $monthlyData = DB::table('author_sales')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(amount) as total_sales'),
                DB::raw('SUM(author_earning) as total_author_earnings'),
                DB::raw('SUM(amount - author_earning) as platform_revenue')
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('year', 'month')
            ->orderBy('month', 'asc')
            ->get();

        foreach ($monthlyData as $data) {
            $monthKey = $data->year . '-' . str_pad($data->month, 2, '0', STR_PAD_LEFT);

            if (isset($monthRange[$monthKey])) {
                $monthRange[$monthKey]['total_sales'] = round($data->total_sales, 2);
                $monthRange[$monthKey]['total_author_earnings'] = round($data->total_author_earnings, 2);
                $monthRange[$monthKey]['platform_revenue'] = round($data->platform_revenue, 2);
            }
        }

        $months = [];
        $totalSales = [];
        $authorEarnings = [];
        $platformRevenue = [];

        foreach ($monthRange as $data) {
            $months[] = $data['month_name'];
            $totalSales[] = $data['total_sales'];
            $authorEarnings[] = $data['total_author_earnings'];
            $platformRevenue[] = $data['platform_revenue'];
        }

        $chartData = [
            'months' => $months,
            'series' => [
                [
                    'name' => 'Total Sales',
                    'type' => 'column',
                    'data' => $totalSales,
                ],
                [
                    'name' => 'Author Commissions',
                    'type' => 'line',
                    'data' => $authorEarnings,
                ],
                [
                    'name' => 'Platform Revenue',
                    'type' => 'area',
                    'data' => $platformRevenue,
                ],
            ],
            'year' => $year,
        ];

        $years = DB::table('author_sales')
            ->select(DB::raw('YEAR(created_at) as year'))
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();

        $sales = [
            'day' => AuthorSale::whereDate('created_at', Carbon::today())->sum('amount'),
            'week' => AuthorSale::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount'),
            'month' => AuthorSale::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('amount'),
            'year' => AuthorSale::whereYear('created_at', Carbon::now()->year)->sum('amount'),
        ];

        $statusCount = Item::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $kycCount = KycVerification::where('status', 'pending')->count();
        $orderCount = Purchase::count();
        $withdrawCount = Withdraws::where('status', 'pending')->count();

        $orders = Purchase::latest()->take(10)->get();
        return view('admin.dashboard.index', compact(
            'chartData',
            'years',
            'sales',
            'statusCount',
            'kycCount',
            'orderCount',
            'withdrawCount',
            'orders'
        ));
    }
}
