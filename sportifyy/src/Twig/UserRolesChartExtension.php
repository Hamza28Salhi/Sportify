<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class UserRolesChartExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('getUserRolesChartData', [$this, 'getUserRolesChartData']),
        ];
    }

    public function getUserRolesChartData($roleCounts)
    {
        $chartData = [
            'labels' => [],
            'datasets' => [
                [
                    'data' => [],
                    'backgroundColor' => [],
                ]
            ]
        ];

        foreach ($roleCounts as $role => $count) {
            $chartData['labels'][] = $role;
            $chartData['datasets'][0]['data'][] = $count;
            $chartData['datasets'][0]['backgroundColor'][] = '#' . dechex(rand(0x000000, 0xFFFFFF));
        }

        return json_encode($chartData);
    }
}