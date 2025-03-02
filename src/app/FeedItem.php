<?php

declare(strict_types=1);

namespace App;

class FeedItem
{
    private string $title;
    private string $description;
    private string $link;
    private string $date;
    private string $category;
    private string $imageUrl;


    public function __construct(
        \SimpleXMLElement $title,
        \SimpleXMLElement $description,
        \SimpleXMLElement $link,
        string $date,
        \SimpleXMLElement $category,
        \SimpleXMLElement|null $imageUrl
    ) {
        $this->title = (string)$title;
        $this->description = (string)$description;
        $this->link = (string)$link;
        $this->date = $date;
        $this->category = (string)$category;
        $this->imageUrl = (string)$imageUrl;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }
}