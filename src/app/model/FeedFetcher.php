<?php

declare(strict_types=1);

namespace App\model;

class FeedFetcher
{
    public static function getFeed(string $url): string
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}