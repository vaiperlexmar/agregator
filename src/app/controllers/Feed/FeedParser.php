<?php

declare(strict_types=1);

namespace App\controllers\Feed;

class FeedParser
{
    private array $feed;

    public static function parse($response): array
    {
        $xml = simplexml_load_string($response);
        $itemsOfNews = $xml->xpath('//item');

        foreach ($itemsOfNews as $item) {
            self::$feed[] = new FeedItem(
                $item->title,
                $item->description,
                $item->link,
                self::formatDate((string)$item->pubDate),
                $item->category,
                $item->enclosure->attributes()->url
            );
        }

        return self::$feed;
    }

    private function formatDate(string $date): string
    {
        $dateOfPublication = date_create_from_format('D, d M Y H:i:s O', $date);
        return date_format($dateOfPublication, "M d, Y | H:i");
    }
}