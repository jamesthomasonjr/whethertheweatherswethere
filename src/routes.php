<?php
// Routes

$app->get('/', 'controllers.index:index');

$app->group('/cities', function () use ($app) {

    // If the user has JavaScript disabled they'll request /cities?name=abc instead of /cities/abc
    // I'd rather handle the redirect logic in the routes than in the controller method
    $queryRedirect = function ($request, $response, $next) {
        $cityName = $request->getParam('name');

        if ($cityName) {
            $response = $response->withRedirect("/cities/{$cityName}");
        } else {
            $response = $next($request, $response);
        }
        return $response;
    };

    $app->get('/', 'controllers.cities:index')->add($queryRedirect);
    $app->get('/{cityName}/', 'controllers.cities:cityByName');
});

