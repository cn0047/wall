<?php

declare(strict_types=1);

namespace PlainPHP\View\Index;

class Index
{
    public function __toString(): string
    {
        return file_get_contents(APP_DIR . '/src/web/html/implementation/jquery/index.html');
    }
}
