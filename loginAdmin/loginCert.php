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

    if (password_verify($_POST["password"], $result["geslo"])) {
    //if ($result["geslo"] === SHA1($_POST["password"])) {

        $_SESSION["idUporabnik"] = $result["idUporabnik"];
        $_SESSION["idVloga"] = $result["idVloga"];

        if ($result["idVloga"] === "1") {
            PrijavaLogDB::insert(["idUporabnik" => $result["idUporabnik"]]);
            header("Location:adminpanel");
        }
        elseif ($result["idVloga"] === "2") {
            PrijavaLogDB::insert(["idUporabnik" => $result["idUporabnik"]]);
            header("Location:sellerpanel");
        }
        else
            header("Location:store");
        exit;

    } else {
        header("refresh:5;url=login");
        echo "Napacno geslo. baza: " . $result["geslo"] . " Vtipkano: " . $_POST["password"];
        exit;
    }
} catch (InvalidArgumentException $e) {
    header("refresh:5;url=login");
    echo($e->getMessage());
}