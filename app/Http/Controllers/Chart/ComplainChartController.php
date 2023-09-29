<?php

namespace App\Http\Controllers\Chart;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComplainChartController extends Controller
{
    public function getLast12MonthsData()
    {
        $startDate = Carbon::now()->subMonths(11); // Get the start date as 12 months ago

        $data = DB::table('complains')
            ->select(DB::raw('YEAR(created_at) as year, MONTHNAME(created_at) as monthName'),
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN status = "solved" THEN 1 ELSE 0 END) as solved'),
                DB::raw('SUM(CASE WHEN status = "progress" THEN 1 ELSE 0 END) as progress'),
                DB::raw('SUM(CASE WHEN status = "received" THEN 1 ELSE 0 END) as received'),
                DB::raw('SUM(CASE WHEN status = "pending" THEN 1 ELSE 0 END) as pending')
            )
            ->where('created_at', '>=', $startDate)
            ->groupBy('year', 'monthName')
            ->orderBy('year', 'desc')
            ->orderBy(DB::raw('MONTH(created_at)'), 'desc')
            ->get();

        // Reformat the data
        $formattedData = [];
        foreach ($data as $item) {
            $formattedData[] = [
                'monthName' => $item->monthName,
                'year' => $item->year,
                'total' => $item->total,
                'solved' => $item->solved,
                'progress' => $item->progress,
                'received' => $item->received,
                'pending' => $item->pending,
            ];
        }

        return response()->json(['data' => $formattedData]);
    }
    public function getLast12MonthsDataBycategory($id)
    {
        $category =  ServiceCategory::find($id);
        $startDate = Carbon::now()->subMonths(11); // Get the start date as 12 months ago
        $data = DB::table('complains')
            ->select(DB::raw('YEAR(created_at) as year, MONTHNAME(created_at) as monthName'),
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN status = "solved" THEN 1 ELSE 0 END) as solved'),
                DB::raw('SUM(CASE WHEN status = "progress" THEN 1 ELSE 0 END) as progress'),
                DB::raw('SUM(CASE WHEN status = "received" THEN 1 ELSE 0 END) as received'),
                DB::raw('SUM(CASE WHEN status = "pending" THEN 1 ELSE 0 END) as pending')
            )
            ->where('service_category_id', $id)
            ->where('created_at', '>=', $startDate)
            ->groupBy('year', 'monthName')
            ->orderBy('year', 'desc')
            ->orderBy(DB::raw('MONTH(created_at)'), 'desc')
            ->get();

        // Reformat the data
        $formattedData = [];
        foreach ($data as $item) {
            $formattedData[] = [
                'monthName' => $item->monthName,
                'year' => $item->year,
                'total' => $item->total,
                'solved' => $item->solved,
                'progress' => $item->progress,
                'received' => $item->received,
                'pending' => $item->pending,
            ];
        }

        return response()->json([
            'category' => $category,
            'data' => $formattedData
        ]);
    }
}
