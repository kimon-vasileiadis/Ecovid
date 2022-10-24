<?php

require_once File::build_path(array("controller", "ControllerProduits.php"));

if (!empty($_GET)) {

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    }

    $controller = 'Produits';

    if (isset($_GET['controller'])) {
        $controller = $_GET['controller'];
    }


    $controller_class = "Controller" . ucfirst($controller);

    if (class_exists($controller_class)) {
        if (in_array($action, get_class_methods($controller_class))) {
            $controller_class::$action();
        } else {
            ControllerProduits::error();
        }
    } else {
        ControllerProduits::error();
    }
} else {
    ControllerProduits::readAll();
}
