<?php

use Kernel\Di;
use Kernel\Exception\Di\ConfigNotFoundException;
use Phalcon\Http\Response;
use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    /**
     * @throws ConfigNotFoundException
     * @return Response
     */
    public function indexAction()
    {
        $implementation = Di::getInstance()->getConfig('frontend')['implementation'];
        $tpl = sprintf('%s/src/web/html/implementation/%s/index.html', APP_DIR, $implementation);

        $response = new Response();
        $response->setContent(file_get_contents($tpl));

        return $response;
    }
}
