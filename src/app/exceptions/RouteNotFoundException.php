<?php

namespace App\exceptions;

class RouteNotFoundException extends \Exception
{
    protected $message = '404 Not found';
}