<?php

namespace PlainPHP\Command;

use GuzzleHttp\Psr7\Response;
use Kernel\Exception\InvalidArgument\InvalidMessageArgumentException;
use Wall\Application\Service\Message\MessageService;
use Wall\Application\VO\Message\NewMessage;

class Message
{
    public function create(array $request):Response
    {
        if (!isset($request[3])) {
            throw new InvalidMessageArgumentException('You have to specify message text.');
        }

        $vo = new NewMessage([
            'userId' => (int)isset($request[4]) ?? 0,
            'message' => $request[3],
        ]);
        $id = (new MessageService())->createSimpleMessage($vo);

        return new Response(201, ['Content-Type' => 'application/json'], json_encode(['id' => $id]));
    }
}
