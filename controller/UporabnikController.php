<?php

require_once("model/UporabnikDB.php");
require_once("model/PrijavaLogDB.php");
require_once("model/PostaDB.php");
require_once("ViewHelper.php");

class UporabnikController {

    public static function login() {
        echo ViewHelper::render("view/login.html");
    }

    public static function adminLogin() {
        echo ViewHelper::render("loginAdmin/loginCert.php");
    }

    public static function sellerLogin() {
        echo ViewHelper::render("loginSeller/loginCert.php");
    }

    public static function checkLogin() {
        echo ViewHelper::render("controller/login.php");
    }

    public static function logout() {
        session_destroy();
        header("Location:store");
    }

    public static function register() {
        if (isset($_SESSION["idUporabnik"])) {
            header("Location:store");
            exit;
        } else {
            header("Location:sellerpanel?id=-1");
        }
    }

    public static function captcha() {
        echo ViewHelper::render("controller/captcha.php");
    }

    public static function emailActivation() {
        echo ViewHelper::render("controller/emailActivation.php");
    }

    public static function activateAccount() {
        if (isset($_GET["id"]) && isset($_GET["ime"])) {
            $id = $_GET["id"];
            $ime = $_GET["ime"];

            $bazaUser = UporabnikDB::get(["id" => $id]);
            if($bazaUser["ime"] == $ime) {
                UporabnikDB::updateAktivno(["idUporabnik" => $id, "aktivno" => 1]);
                header("Location:login");
                exit;
            } else {
                header("Location:store");
                exit;
            }
        } else {
            header("Location:store");
            exit;
        }
    }

    public static function layout() {
        echo ViewHelper::render("view/includes/layout.html");
    }

    public static function poste() {
        echo ViewHelper::render("controller/shraniPoste.php");
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
        echo ViewHelper::render("controller/userpanel.php");
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
