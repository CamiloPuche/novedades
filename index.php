<?php

require_once 'Controllers\EmpleadosNovedadesController.php';

$controller = new EmpleadosNovedadesController();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'index';
}

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'create':
        $controller->create();
        break;
    default:
        $controller->index();
        break;
}


