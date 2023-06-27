<?php

namespace App\Charts;

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
        return $this->chart->lineChart()
            ->setTitle('Project Selesai/Tahun')
            ->addData('Digital sales', [70, 29, 77, 28, 55, 45])
            ->setXAxis(['2020', '2021', '2022', '2023', '2024', '2025']);
    }
}
