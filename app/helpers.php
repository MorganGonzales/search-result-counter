<?php

if (!function_exists('formatNumberToOrdinal')) {
    function formatNumberToOrdinal(int $number): string
    {
        $ends = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];

        return ((($number % 100) >= 11) && (($number % 100) <= 13))
            ? $number . 'th'
            : $number . $ends[$number % 10];
    }
}

if (!function_exists('retrieveHostFromUrl')) {
    function retrieveHostFromUrl(string $input): string
    {
        $input = trim($input, '/');

        // If scheme not included, prepend it
        if (!preg_match('#^http(s)?://#', $input)) {
            $input = 'http://' . $input;
        }

        $urlParts = parse_url($input);

        // remove www
        return preg_replace('/^www\./', '', $urlParts['host']);
    }
}
