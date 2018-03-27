<?php

use Kernel\Exception\Di\ConfigNotFoundException;
use Kernel\Exception\Di\PersistenceNotFoundException;
use Phalcon\Http\Response;
use Phalcon\Mvc\Controller;
use ValueObject\Exception\ValidationException;
use Wall\Application\Service\Message\MessageService;
use Wall\Application\VO\Message\GetMessageByCriteria;

class MessagesController extends Controller
{
    /**
     * @param array $data
     * @return Response
     */
    private function returnJsonResponse(array $data): Response
    {
        $this->view->disable();
        $this->response->setContentType('application/json', 'UTF-8');
        $this->response->setContent(json_encode($data));
        return $this->response;
    }

    /**
     * @throws ConfigNotFoundException
     * @throws PersistenceNotFoundException
     * @throws ValidationException
     * @return Response
     */
    public function getAction(): Response
    {
        $valueObject = new GetMessageByCriteria($this->request->getQuery());

        $collection = (new MessageService())->getMessagesByCriteria($valueObject);

        return $this->returnJsonResponse($collection);
    }

    /**
     * @throws ConfigNotFoundException
     * @throws PersistenceNotFoundException
     * @throws ValidationException
     * @return Response
     */
    public function createAction(): Response
    {
        $message = (new MessageService())->createSimpleMessage(
            $this->request->getPost('userId'),
            $this->request->getPost('message')
        );

        return $this->returnJsonResponse($message->toArray());
    }
}
