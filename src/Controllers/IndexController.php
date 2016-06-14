<?php
namespace Weather\Controllers;

use \Slim\Views\PhpRenderer as Renderer;

class IndexController
{
    private $renderer;

    public function __construct(
        Renderer $renderer
    ) {
        $this->renderer = $renderer;
    }

    public function index($request, $response, $args)
    {
        return $this->renderer->render($response, 'index.phtml');
    }
}
