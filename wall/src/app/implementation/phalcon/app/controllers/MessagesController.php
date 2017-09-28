<?php

use Phalcon\Http\Response;
use Phalcon\Mvc\Controller;
use Wall\Application\Service\Message\MessageService;
use Wall\Application\VO\Message\GetMessageByCriteria;

class MessagesController extends Controller
{
    private function returnJsonResponse(array $data): Response
    {
        $this->view->disable();
        $this->response->setContentType('application/json', 'UTF-8');
        $this->response->setContent(json_encode($data));
        return $this->response;
    }

    public function getAction(): Response
    {
        $vo = new GetMessageByCriteria($this->request->getQuery());

        $collection = (new MessageService())->getMessagesByCriteria($vo);

        return $this->returnJsonResponse($collection);
    }

    public function createAction(): Response
    {
        $message = (new MessageService())->createSimpleMessage(
            $this->request->getPost('userId'),
            $this->request->getPost('message')
        );

        return $this->returnJsonResponse($message->toArray());
    }
}
