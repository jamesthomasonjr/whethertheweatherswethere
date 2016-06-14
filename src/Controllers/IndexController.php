<?php
namespace Weather\Controllers;

use \Psr\Http\Message\RequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Slim\Views\PhpRenderer as Renderer;

class IndexController
{
    private $renderer;

    public function __construct(
        Renderer $renderer
    ) {
        $this->renderer = $renderer;
    }

    public function index(Request $request, Response $response, array $args)
    {
        return $this->renderer->render($response, 'index.phtml');
    }
}
