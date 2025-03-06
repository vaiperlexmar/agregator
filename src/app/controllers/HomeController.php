<?php

namespace App\controllers;

use App\controllers\Feed\FeedParser;
use App\model\FeedFetcher;
use App\View;

class HomeController
{
    public function index(): string
    {
        $response = FeedFetcher::getFeed("https://pravoslavie.ru/xml/full.xml");
        $data = FeedParser::parse($response);
       
        $indexNews = View::make("index", $data);
        return $indexNews->render();
    }
}