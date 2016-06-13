<?php
// Routes

$app->get('/', 'controllers.index:index');

$app->group('/cities', function () use ($app) {
    $app->get('/', 'controllers.cities:index');
    $app->get('/{cityName}/', 'controllers.cities:cityByName');
});

