<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

// Force everything to have a trailing slash
$app->add(new \Psr7Middlewares\Middleware\TrailingSlash(true));
