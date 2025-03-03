<?php

namespace App\controllers;

use App\View;

class HomeController
{
    public function index()
    {
        $response = FeedFetcher::getFeed("https://pravoslavie.ru/xml/full.xml");
        $data = FeedParser::parse($response);

        $indexNews = View::make("index", $data);
    }
}