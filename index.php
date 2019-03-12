<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require 'vendor/autoload.php';

interface ControllerInterface
{
    public function getHtml(Request $request): Response;
}

interface RouteInterface
{
    public function checkRoute(Request $request): bool;

    public function getController(): ControllerInterface;
}

class Route
{
    private $pattern;

    private $controller;

    public function __construct(string $pattern, ControllerInterface $controller)
    {
        $this->pattern = $pattern;
        $this->controller = $controller;
    }

    public function checkRoute(Request $request): bool
    {
        if ($request->getRequestUri() === $this->pattern) {
            return true;
        } else {
            return false;
        }
    }

    public function getController(): ControllerInterface
    {
        return $this->controller;
    }

}

require 'config.php';


// сейчас у нас запрос /b
$request = Request::createFromGlobals();

/** @var RouteInterface $route */
foreach ($routes as $route) {
    if ($route->checkRoute($request)) {
        /** @var ControllerB $controller */
        $controller = $route->getController();
        break;
    }
}

$response = $controller->getHtml($request);

