<?php
namespace Weather\Controllers;

use \Psr\Http\Message\RequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Slim\Views\Twig as Renderer;

class IndexController
{
    /**
     * @var Renderer $renderer Renderer to build a take a ViewModel array and build a View
     */
    private $renderer;

    /**
     * Creates a new IndexController
     *
     * @param Renderer $renderer
     */
    public function __construct(
        Renderer $renderer
    ) {
        $this->renderer = $renderer;
    }

    /**
     * Builds the Main Index page
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     *
     * @return Response $view
     */
    public function index(Request $request, Response $response, array $args)
    {
        return $this->renderer->render($response, 'index.html');
    }
}
