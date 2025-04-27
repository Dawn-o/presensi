<?php

namespace App\Helpers;

class IpHelper
{
    public static function isAllowedIp($ip)
    {
        $allowedIps = explode(',', env('ALLOWED_ABSEN_IP', ''));
        return in_array($ip, $allowedIps);
    }
}
