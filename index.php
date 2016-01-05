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
    "login" => function () {
        UporabnikController::login();
    },
    "checkLogin" => function () {
        UporabnikController::checkLogin();
    },
    "logout" => function () {
        UporabnikController::logout();
    },
    "register" => function () {
        UporabnikController::register();
    },
    "captcha" => function () {
        UporabnikController::captcha();
    },
    "emailActivation" => function () {
        UporabnikController::emailActivation();
    },
    "activate" => function () {
        UporabnikController::activateAccount();
    },
    "shraniPoste" => function () {
        UporabnikController::poste();
    },
    "adminpanel" => function () {
        UporabnikController::adminPanel();
    },
    "prodajalci" => function () {
        UporabnikController::sellers();
    },
    "sellerpanel" => function () {
        UporabnikController::sellerPanel();
    },
    "userpanel" => function () {
        UporabnikController::editUser();
    },
    "store" => function () {
        IzdelkiController::index();
    },
    "store/cart" => function(){
        IzdelkiController::cart();
    },
    "" => function () {
        ViewHelper::redirect("store");
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
