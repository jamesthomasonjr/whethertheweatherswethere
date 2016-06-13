<?php
namespace Weather\Controllers;

class IndexController {
    public function __construct() {
    }

    public function index($request, $response, $args) {
        return 'Site Index';
    }
}
