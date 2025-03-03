<?php

namespace App\exceptions;

class ViewNotFoundException extends \Exception
{
    protected $message = "View Not Found";
}