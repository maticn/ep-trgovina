<?php
/**
 * Created by PhpStorm.
 * User: ep
 * Date: 31.12.2015
 * Time: 12:55
 */

// posodobi status uporabnika
if (isset($_GET["aktivno"]) && isset($_GET["id"]) && $_GET["id"] != -1) {
    // le administrator !
    $params = array("idUporabnik" => filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS), "aktivno" => filter_input(INPUT_GET, 'aktivno', FILTER_SANITIZE_SPECIAL_CHARS));
    UporabnikDB::updateAktivno($params);

    if (isset($_GET["f"]) && $_GET["f"] == "p") {
        header("Location:prodajalci");
        exit;
    } else if (isset($_GET["f"]) && $_GET["f"] == "c") {
        header("Location:sellerpanel?manage");
        exit;
    }

    header("Location:adminpanel?id=" . $_GET['id']);
    exit;
}

// posodobi uporabnika
if (isset($_POST["id"]) && $_POST["id"] != -1 && isset($_POST["idVloga"]) && $_POST["idVloga"] != null) {
    // posodobi uporabnika
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

    if (isset($_POST["password"]) && $_POST["password"] === $_POST["confirm"] && !empty($_POST["password"])) {
        $params = array("idUporabnik" => $id, "geslo" => filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));
        UporabnikDB::updatePass($params);

    }

    if (isset($_POST["ime"]) && !empty($_POST["ime"]) && isset($_POST["priimek"]) && !empty($_POST["priimek"])) {
        $params = array("idUporabnik" => $id, "ime" => filter_input(INPUT_POST, 'ime', FILTER_SANITIZE_SPECIAL_CHARS), "priimek" => filter_input(INPUT_POST, 'priimek', FILTER_SANITIZE_SPECIAL_CHARS));
        UporabnikDB::update($params);
    }

    if (isset($_POST["naslov"]) && !empty($_POST["naslov"]) && isset($_POST["idPosta"]) && !empty($_POST["idPosta"]) && isset($_POST["telefon"]) && !empty($_POST["telefon"])) {
        $params = array("idUporabnik" => $id, "naslov" => filter_input(INPUT_POST, 'naslov', FILTER_SANITIZE_SPECIAL_CHARS), "idPosta" => filter_input(INPUT_POST, 'idPosta', FILTER_SANITIZE_SPECIAL_CHARS), "telefon" => filter_input(INPUT_POST, 'telefon', FILTER_SANITIZE_SPECIAL_CHARS));
        UporabnikDB::updateStranka($params);
    }

    if ($_POST["idVloga"] === "2") {
        header("Location:prodajalci");
        exit;
    } elseif ($_POST["idVloga"] === "1") {
        header("Location:adminpanel");
        exit;
    } elseif ($_POST["idVloga"] === "3") {
        if (isset($_POST["editing"]) && $_POST["editing"] == "customer") {
            if($_SESSION["idVloga"] == 1 || $_SESSION["idVloga"] == 2) {
                header("Location:sellerpanel?manage");
                exit;
            } else {
                header("Location:sellerpanel?id=$id");
                exit;
            }
        } else {
            header("Location:sellerpanel");
            exit;
        }
    }
}

// ustvari uporabnika
if (isset($_POST["id"]) && $_POST["id"] == -1 && isset($_POST["idVloga"]) && $_POST["idVloga"] != null) {

    if (isset($_POST["email"]) && !empty($_POST["email"])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    if (isset($_POST["password"]) && $_POST["password"] === $_POST["confirm"] && !empty($_POST["password"])) {
        $geslo = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    if (isset($_POST["ime"]) && !empty($_POST["ime"])) {
        $ime = filter_input(INPUT_POST, 'ime', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    if (isset($_POST["priimek"]) && !empty($_POST["priimek"])) {
        $priimek = filter_input(INPUT_POST, 'priimek', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    if (isset($_POST["idVloga"]) && !empty($_POST["idVloga"])) {   //type
        $idVloga = filter_input(INPUT_POST, 'idVloga', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // stranka
    $naslov = null;
    $idPosta = null;
    $telefon = null;
    if (isset($_POST["naslov"]) && !empty($_POST["naslov"])) {
        $naslov = filter_input(INPUT_POST, 'naslov', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    if (isset($_POST["idPosta"]) && !empty($_POST["idPosta"])) {
        $idPosta = filter_input(INPUT_POST, 'idPosta', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    if (isset($_POST["telefon"]) && !empty($_POST["telefon"])) {
        $telefon = filter_input(INPUT_POST, 'telefon', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    UporabnikDB::insert(
        [
            "ime" => $ime, "priimek" => $priimek, "email" => $email, "geslo" => $geslo, "idVloga" => $idVloga,
            "naslov" => $naslov, "idPosta" => $idPosta, "telefon" => $telefon
        ]
    );


    if($_POST["registracija"] === "1") {                // registracija uporabnika
        header("Location:login");
        exit;
    } elseif ($_POST["idVloga"] === "2") {              // prodajalec
        header("Location:prodajalci");
        exit;
    } elseif ($_POST["idVloga"] === "3") {              // stranka
        header("Location:sellerpanel?manage");
        exit;
    }
}

// nismo bili v nobenem if-u, preusmerimo na trgovino
header("Location:store");
