<?php

declare(strict_types=1);

use Kernel\Di;
use Phalcon\Http\Response;
use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $implementation = Di::getInstance()->getConfig('frontend')['implementation'];
        $tpl = sprintf('%s/src/web/html/implementation/%s/index.html', APP_DIR, $implementation);

        $response = new Response();
        $response->setContent(file_get_contents($tpl));

        return $response;
    }
}
