<?php
namespace Weather\Controllers;

class CitiesController {
    public function __construct() {
    }

    public function index($request, $response, $args) {
        return 'Cities Index';
    }

    public function cityById($request, $response, $args) {
        return "City By ID: {$args['cityId']}";
    }
}
