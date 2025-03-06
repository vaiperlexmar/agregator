<?php

declare(strict_types=1);

use App\controllers\HomeController;
use App\core\Router;
use App\View;

require __DIR__.'/../vendor/autoload.php';

const VIEW_PATH = __DIR__.'/../view/';

try {
    $router = new Router();

    $router->get("/", [HomeController::class, "index"]);

    echo $router->resolve($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]);
} catch (\App\exceptions\RouteNotFoundException $exception) {
    echo View::make("404");
}