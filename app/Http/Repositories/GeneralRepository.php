<?php

namespace App\Http\Repositories;

class GeneralRepository 
{
    public function customDateRange($dateRange)
    {
        $arrayDate = explode("-", $dateRange);
        $startDate = rtrim($arrayDate[0]);
        $endDate = ltrim($arrayDate[1]);

        return [
            'startDate' => customTanggal($startDate, 'd/m/Y', 'Y-m-d'),
            'endDate' => customTanggal($endDate, 'd/m/Y', 'Y-m-d')
        ];
    }
}