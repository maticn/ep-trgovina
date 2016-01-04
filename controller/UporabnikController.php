<?php

require_once("model/UporabnikDB.php");
require_once("model/PostaDB.php");
require_once("ViewHelper.php");

class UporabnikController {

    public static function login() {
        echo ViewHelper::render("view/login.html");
    }

    public static function checkLogin() {
        echo ViewHelper::render("view/login.php");
    }

    public static function layout() {
        echo ViewHelper::render("view/includes/layout.html");
    }

    public static function adminPanel() {
        echo ViewHelper::render("view/adminpanel.php");
    }

    public static function sellers() {
        echo ViewHelper::render("view/prodajalci.php");
    }

    public static function sellerPanel() {
        echo ViewHelper::render("view/sellerpanel.php");
    }

    public static function editUser() {
        echo ViewHelper::render("view/userpanel.php");
    }

    public static function customerPanel() {
        echo ViewHelper::render("view/customerpanel.php");
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
