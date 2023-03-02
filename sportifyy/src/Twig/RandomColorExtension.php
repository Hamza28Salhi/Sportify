<?php
namespace App\Twig;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class RandomColorExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('random_color', [$this, 'generateRandomColor']),
        ];
    }

    public function generateRandomColor()
    {
        $hex = '#';
        for ($i = 0; $i < 6; $i++) {
            $hex .= dechex(rand(0, 15));
        }
        return $hex;
    }
}