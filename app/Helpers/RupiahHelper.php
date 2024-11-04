<?php

if (!function_exists('rp_format')) {
    function rp_format($number)
    {
        return 'Rp ' . number_format($number, 0, ',', '.');
    }
}
