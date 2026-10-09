<?php

if (!function_exists('indian_number_format')) {
    function indian_number_format($number) {

        // If value is null, empty, or not numeric → return blank
        if ($number === null || $number === '' || !is_numeric($number)) {
            return '';
        }

        // Convert to float before formatting
        $number = (float) $number;

        $formatter = new \NumberFormatter('en_IN', \NumberFormatter::DECIMAL);
        $formattedNumber = $formatter->format($number);

        return '₹ ' . $formattedNumber; // Add Rupee symbol
    }
}
