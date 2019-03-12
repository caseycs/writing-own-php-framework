<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ControllerA implements ControllerInterface
{
    public function getHtml(Request $request): Response
    {
        return new Response('a');
    }
}

class ControllerB implements ControllerInterface
{
    public function getHtml(Request $request): Response
    {
        return new Response('b');
    }
}

$routes = [];

$routes[] = new Route('/a', new ControllerA);

$controllerB = new ControllerB;
$routes[] = new Route('/b', $controllerB);

