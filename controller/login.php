<?php
/**
 * Created by PhpStorm.
 * User: ep
 * Date: 30.12.2015
 * Time: 15:37
 */

try {
    if ($_POST["email"] != null && !empty($_POST["email"])) {
        $username = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
        $result = UporabnikDB::getUser(["email" => $username]);
    } else {
        header("refresh:5;url=login");
        echo "Vnesite uporabnisko ime.";
        exit;
    }

    if ($result["idVloga"] == 1) {
        if (!(isset($_SESSION["certRole"]) && $_SESSION["certRole"] == 1)) {
            // prijaviti se je zelel administrator, vendar ni podal certifikata
            header("refresh:5;url=store");
            echo "Niste podali certifikata administratorja.";
            exit;
        }
    } else if ($result["idVloga"] == 2) {
        if (!(isset($_SESSION["certRole"]) && $_SESSION["certRole"] == 2)) {
            // prijaviti se je zelel prodajalec, vendar ni podal certifikata
            header("refresh:5;url=store");
            echo "Niste podali certifikata prodajalca.";
            exit;
        }
    }

    if (password_verify($_POST["password"], $result["geslo"])) {
        //if ($result["geslo"] === SHA1($_POST["password"])) {

        $_SESSION["idUporabnik"] = $result["idUporabnik"];
        $_SESSION["idVloga"] = $result["idVloga"];

        if ($result["idVloga"] === "1") {
            PrijavaLogDB::insert(["idUporabnik" => $result["idUporabnik"]]);
            header("Location:adminpanel");
        } elseif ($result["idVloga"] === "2") {
            PrijavaLogDB::insert(["idUporabnik" => $result["idUporabnik"]]);
            header("Location:sellerpanel");
        } else
            header("Location:store");
        exit;

    } else {
        header("refresh:5;url=login");
        echo "Napacno geslo.";
        exit;
    }
} catch (InvalidArgumentException $e) {
    header("refresh:5;url=login");
    echo($e->getMessage());
}
