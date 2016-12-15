<?php

declare(strict_types=1);

namespace PlainPHP\Controller;

use GuzzleHttp\Psr7\Response;
use PlainPHP\View\Index\Index as View;

class Index
{
    public function index(): Response
    {
        return new Response(200, ['Content-Type' => 'application/json'], new View());
    }
}
