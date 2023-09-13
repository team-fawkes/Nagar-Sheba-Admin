<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use App\Models\Complain; // Import the Complain model
use Carbon\Carbon;

class ComplainChart extends BarChartWidget
{
    protected static ?string $heading = 'Complaint Status';


    protected function getData(): array
    {
        $currentYear = Carbon::now()->year;

        $complaints = Complain::whereYear('created_at', $currentYear)->get();

        // Initialize datasets for all months with counts set to 0
        $months = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
        ];
        $pendingData = array_fill_keys($months, 0);
        $receivedData = array_fill_keys($months, 0);
        $progressData = array_fill_keys($months, 0);
        $solvedData = array_fill_keys($months, 0);

        // Loop through the complaints and update the counts for each month
        foreach ($complaints as $complaint) {
            $status = $complaint->status;
            $createdAt = $complaint->created_at;

            // Determine the label (e.g., 'Jan', 'Feb', etc.) based on the created_at date
            $label = $createdAt->format('M');
            if ($status === 'pending') {
                $pendingData[$label]++;
            } elseif ($status === 'received') {
                $receivedData[$label]++;
            } elseif ($status === 'progress') {
                $progressData[$label]++;
            } elseif ($status === 'solved') {
                $solvedData[$label]++;
            }
        }

        // Extract labels and data points for the chart
        $labels = array_keys($pendingData); // Assuming labels are the same for both datasets
        $pendingData = array_values($pendingData);
        $solvedData = array_values($solvedData);
        $receivedData = array_values($receivedData);
        $progressData = array_values($progressData);

        return [
            'datasets' => [
                [
                    'label' => "Pending",
                    'data' => $pendingData,
                    'backgroundColor' => 'rgba(255,255,0)',
                    'borderColor' => 'rgb(139, 128, 0)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => "Received",
                    'data' => $receivedData,
                    'backgroundColor' => 'rgb(255,69,0)',
                    'borderColor' => 'rgba(255, 140,0)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => "Progress",
                    'data' => $progressData,
                    'backgroundColor' => 'rgba(0,0,255)',
                    'borderColor' => 'rgb(0, 0, 139)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => "Solved",
                    'data' => $solvedData,
                    'backgroundColor' => 'rgb(0,128,0)',
                    'borderColor' => 'rgb(0,100,0)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }
}
