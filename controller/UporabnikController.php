<?php

require_once("model/UporabnikDB.php");
require_once("ViewHelper.php");

class UporabnikController {

    public static function index() {
        echo ViewHelper::render("view/login.html");
    }

    public static function login() {
        echo ViewHelper::render("view/login.php");
    }

    public static function edit() {
        echo ViewHelper::render("view/adminpanel.php");
    }

    public static function add() {
        $form = new BooksInsertForm("add_form");

        if ($form->isSubmitted() && $form->validate()) {
            $id = BookDB::insert($form->getValue());
            ViewHelper::redirect(BASE_URL . "books?id=" . $id);
        } else {
            echo ViewHelper::render("view/book-form.php", [
                "title" => "Add book",
                "form" => $form
            ]);
        }
    }

}
