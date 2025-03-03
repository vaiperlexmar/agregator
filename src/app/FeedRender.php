<?php

namespace App;

class FeedRender
{
    private array $feed;
    private string $html = "";

    public function __construct(array $feed)
    {
        $this->feed = $feed;
    }

    public function render(): string
    {
        foreach ($this->feed as $feedItem) {
            $this->html .= <<<HTML
                <a class="news__link" href="{$feedItem->getLink()}">
                    <div class="news__content">
                        <img class="news__img" src="{$feedItem->getImageUrl()}" />
                        <h2 class="news__title">{$feedItem->getTitle()}</h2>
                        <p class="news__description">{$feedItem->getDescription()}</p>
                        <span class="news__date">{$feedItem->getDate()}</span>
                    </div>
                </a>
            HTML;
        }

        return $this->html;
    }
}