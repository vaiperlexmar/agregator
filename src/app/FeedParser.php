<?php

declare(strict_types=1);

namespace App;

class FeedParser
{
    private array $feed;

    public function parse($response): array
    {
        $xml = simplexml_load_string($response);
        $itemsOfNews = $xml->xpath('//item');

        foreach ($itemsOfNews as $item) {
            $this->feed[] = new FeedItem(
                $item->title,
                $item->description,
                $item->link,
                $this->formatDate((string)$item->pubDate),
                $item->category,
                $item->enclosure->attributes()->url
            );
        }

        return $this->feed;
    }

    private function formatDate(string $date): string
    {
        $dateOfPublication = date_create_from_format('D, d M Y H:i:s O', $date);
        return date_format($dateOfPublication, "M d, Y | H:i");
    }
}