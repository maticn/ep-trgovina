<?php
/**
 * Created by PhpStorm.
 * User: ep
 * Date: 30.12.2015
 * Time: 15:37
 */

//require 'model/UporabnikDB.php';

try {
    if ($_POST["email"] != null && !empty($_POST["email"])) {
        $username = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
        $result = UporabnikDB::getUser(["email" => $username]);
    } else {
        header("refresh:5;url=" . $_SERVER["SCRIPT_NAME"] . "/login");
        echo "Vnesite uporabnisko ime.";
        exit;
    }

    //if (password_verify($_POST["password"], $result["geslo"])) {
    if ($result["geslo"] === SHA1($_POST["password"])) {

        $_SESSION["idUporabnik"] = $result["idUporabnik"];

        if ($result["idVloga"] === "1")
            header("Location:adminpanel.php");
        elseif ($result["idVloga"] === "2")
            header("Location:editseller.php");
        else
            header("Location:store.php");
        exit;

    } else {
        header("refresh:5;url=" . $_SERVER["SCRIPT_NAME"] . "/login");
        echo "Napacno geslo.";
        exit;
    }
} catch (InvalidArgumentException $e) {
    header("refresh:5;url=" . $_SERVER["SCRIPT_NAME"] . "/login");
    echo($e->getMessage());
}