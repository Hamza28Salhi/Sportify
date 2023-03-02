<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ArrayExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('values', 'array_values'),
        ];
    }
}