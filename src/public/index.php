<?php

declare(strict_types=1);

use App\FeedFetcher;
use App\FeedParser;
use App\FeedRender;

require __DIR__.'/../vendor/autoload.php';

$feedFetcher = new FeedFetcher();
$response = $feedFetcher->getFeed("https://pravoslavie.ru/xml/full.xml");

$feedParser = new FeedParser();
$response = $feedParser->parse($response);

$pravoslavieRuRender = new FeedRender($response);
echo $pravoslavieRuRender->render();
