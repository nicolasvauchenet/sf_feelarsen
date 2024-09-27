<?php

namespace App\Twig\Filters;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class PhoneFilter extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('format_phone', [$this, 'formatPhone']),
        ];
    }

    public function formatPhone($number, $format = 'spaced'): array|string|null
    {
        // Remove spaces and dots
        $number = str_replace([' ', '.'], '', $number);

        // Replace leading 0 with +33
        if(str_starts_with($number, '0')) {
            $number = '+33' . substr($number, 1);
        }

        if($format === 'spaced') {
            // Format as +33 $1 $2 $3 $4 $5
            return preg_replace("/^\+33(\d)(\d{2})(\d{2})(\d{2})(\d{2})$/", "+33 $1 $2 $3 $4 $5", $number);
        } else if($format === 'compact') {
            // Format as +33$1$2$3$4$5
            return preg_replace("/^\+33(\d)(\d{2})(\d{2})(\d{2})(\d{2})$/", "+33$1$2$3$4$5", $number);
        }

        return $number;
    }
}
