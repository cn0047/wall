<?php

namespace PlainPHP\View\Index;

use Kernel\Di;
use Kernel\Exception\Di\ConfigNotFoundException;

class Index
{
    /**
     * @return string
     * @throws ConfigNotFoundException
     */
    public function __toString(): string
    {
        $implementation = Di::getInstance()->getConfig('frontend')['implementation'];
        $tpl = sprintf('%s/src/web/html/implementation/%s/index.html', APP_DIR, $implementation);
        return file_get_contents($tpl);
    }
}
