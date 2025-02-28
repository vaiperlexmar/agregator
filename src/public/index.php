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

$html = '
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Дока</title>
  </head>
  <body>
';

function xmlToHtml($xml) {
    $html = '';
    foreach ($xml->children() as $child) {
        if ($child->children()->count() > 0) {
            $html .= '<div class="' . $child->getName() . '">';
            $html .= xmlToHtml($child);
            $html .= '</div>';
        } else {
            $html .= '<div class="' . $child->getName() . '">';
        }
    }

    return $html;
}

$html .= xmlToHtml($xml);
echo $html;