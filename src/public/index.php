<?php

declare(strict_types=1);

use App\FeedFetcher;
use App\FeedParser;
use App\FeedRender;

require __DIR__.'/../vendor/autoload.php';

const LAYOUT_PATH = __DIR__.'/../view/';

$feedFetcher = new FeedFetcher();
$response = $feedFetcher->getFeed("https://pravoslavie.ru/xml/full.xml");

$feedParser = new FeedParser();
$response = $feedParser->parse($response);

$pravoslavieRuRender = new FeedRender($response);
$renderedNews = $pravoslavieRuRender->render();

$indexHTML = file_get_contents(LAYOUT_PATH."index.php");
$html = str_replace('{{CONTENT}}', $renderedNews, $indexHTML);
echo $html;