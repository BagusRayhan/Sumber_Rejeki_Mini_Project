<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->setTitle('Jumlah Project Selesai')
            ->addData('Project Selesai', [5, 10, 15, 20])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}
