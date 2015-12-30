<?php
/**
 * Created by PhpStorm.
 * User: ep
 * Date: 30.12.2015
 * Time: 15:37
 */

require 'model/UporabnikDB.php';

if ($_POST["email"] != null && !empty($_POST["email"])) {
    $username = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $result = UporabnikDB::getUser(["email" => $username, "aktivno" => "1"]);
}

try {
    if (count($result) == 1) {

        //if ($result["geslo"] === SHA1($_POST["password"])) {
        if (password_verify($_POST["password"], $result["geslo"])) {
                $_SESSION["idUporabnik"] = $result["idUporabnik"];

                if ($result["idVloga"] === "1")
                    header("Location:editadmin.php");
                elseif ($result["idVloga"] === "2")
                    header("Location:editseller.php");
                else
                    header("Location:store.php");
                exit;

        } else {
            header("refresh:5;url=login.html");
            echo "Napacno uporabnisko ime ali geslo.";
            exit;
        }
    } else {
            header("refresh:5;url=login.html");
            echo "Uporabnik ne obstaja.";
            exit;
    }
} catch (InvalidArgumentException $e) {
    echo ($e->getMessage());
}