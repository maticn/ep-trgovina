<?php

// enables sessions for the entire app
session_start();

//require_once("controller/BooksController.php");
require_once("controller/IzdelkiController.php");
require_once("controller/UporabnikController.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

// ROUTER: defines mapping between URLS and controllers
$urls = [
    "izdelki" => function () {
        IzdelkiController::index();
    },
    "login" => function () {
        UporabnikController::index();
    },
    "view/login.php" => function () {
        UporabnikController::login();
    },
    "view/adminpanel.php" => function () {
        UporabnikController::edit();
    },
    "view/sellerpanel.php" => function () {
        UporabnikController::editSeller();
    },
    "view/userpanel.php" => function () {
        UporabnikController::editUser();
    },
    "view/aktivacija.php" => function () {
        UporabnikController::akctivate();
    },
    "books/add" => function () {
        BooksController::add();
    },
    "books/edit" => function () {
        BooksController::edit();
    },
    "books/delete" => function () {
        BooksController::delete();
    },
    "" => function () {
        ViewHelper::redirect(BASE_URL . "login");
    },
];

try {
    if (isset($urls[$path])) {
        $urls[$path]();
    } else {
        echo "No controller for '$path'";
    }
} catch (InvalidArgumentException $e) {
    ViewHelper::error404();
} catch (Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
} 
