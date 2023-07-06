<?php

namespace App\Charts;

use App\Models\proreq;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Carbon as SupportCarbon;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $selesaiProjects = proreq::where('status', 'selesai')
        ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month')
        ->toArray();
    
    // dd($selesaiProjects);
     
    
        $months = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
    
        $selesaiProjects = $this->fillMissingMonths($selesaiProjects, $months);
    
        return $this->chart->barChart()
            ->setTitle('Jumlah Project Selesai')
            ->addData('Project Selesai', $selesaiProjects)
            ->setXAxis($months);
    }
    
    private function generateMonths($startMonth)
    {
        $months = [];
        $month = Carbon::createFromFormat('F', $startMonth);
    
        for ($i = 0; $i < 12; $i++) {
            $months[] = $month->format('F');
            $month->addMonth();
        }
    
        return $months;
    }
    
    private function fillMissingMonths($data, $months)
    {
        $result = [];
    
        foreach ($months as $index => $month) {
            $monthIndex = $index + 1;
            $count = isset($data[$monthIndex]) ? $data[$monthIndex] : 0;
            $result[$monthIndex] = $count;
        }
    
        return array_values($result);
    }
    
}
