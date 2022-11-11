<?php

namespace Reverb\Http\Controllers;

use Psr\Http\Message\RequestInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServerInterface;
use Reverb\Event;
use Symfony\Component\HttpFoundation\JsonResponse;

class EventController implements HttpServerInterface
{
    public function onOpen(ConnectionInterface $conn, RequestInterface $request = null)
    {
        dump($request->getBody());

        Event::dispatch(
            (string) $request->getBody()
        );

        tap($conn)->send(new JsonResponse((object) []))->close();
    }

    public function onMessage(ConnectionInterface $from, $message)
    {
        //
    }

    public function onClose(ConnectionInterface $connection)
    {
        //
    }

    public function onError(ConnectionInterface $connection, \Exception $e)
    {
        //
    }
}
