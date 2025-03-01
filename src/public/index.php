<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$ch = curl_init();
$url = "https://pravoslavie.ru/xml/full.xml";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

$response = curl_exec($ch);

curl_close($ch);

$xml = simplexml_load_string($response);
$itemsOfNews = $xml->xpath('//item');

$html = '
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>RSS Православие</title>
  </head>
  <body>
';

function xmlToHtml($itemsOfNews): string {
    $html = '';
    foreach ($itemsOfNews as $item) {
        $dateOfPublication = date_create_from_format('D, d M Y H:i:s O', (string) $item->pubDate);
        $dateOfPublication = date_format($dateOfPublication, "M d, Y | H:i");
        $newsItem = <<<HTML
        <a class="news__link" href="$item->link">
            <div class="news">
                <h2 class="news__title">{$item->title}</h2>
                <img class="news__img" src="{$item->enclosure->attributes()->url}">
                <p class="news__description">{$item->description}</p>
                <p class="news__date">{$dateOfPublication}</p>
            </div>
        </a>
HTML;
    $html .= $newsItem;
    }

    return $html;
}

$html .= xmlToHtml($itemsOfNews);
echo $html;