<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Proreq;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class AnnualyDoneChart
{
    protected $chart;

    public function __construct(LarapexChart $ychart)
    {
        $this->chart = $ychart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $selesaiProjects = Proreq::where('status', 'selesai')
            ->selectRaw('YEAR(created_at) as year, COUNT(*) as count')
            ->groupBy('year')
            ->orderBy('year')
            ->pluck('count', 'year')
            ->toArray();
    
        $years = array_keys($selesaiProjects);
        $projectCounts = array_values($selesaiProjects);
    
        return $this->chart->lineChart()
            ->setTitle('Project Selesai/Tahun')
            ->addData('Project Selesai', $projectCounts)
            ->setXAxis($years);
    }
}
