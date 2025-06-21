<?php

namespace App\Helpers;

class Helpers
{
    public static function getBadgeClass($status)
    {
        return match($status) {
            'pending' => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
            default => 'secondary',
        };
    }
}