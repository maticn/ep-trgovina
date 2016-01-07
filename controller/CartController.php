<?php

require_once("ViewHelper.php");
require_once("model/IzdelekDB.php");


class CartController
{

    public static function index()
    {
        $izdelki = [];
        if (isset($_SESSION["cart"])) {
            $vozick = $_SESSION["cart"];
            foreach ($vozick as $id => $kolicina) {
                $izdelki[] = array_merge(IzdelekDB::get(["id" => $id]), ["kolicina" => $kolicina]);
            }
        }

        echo ViewHelper::render("view/cart.php", ["izdelki" => $izdelki]);
    }

    public static function ajax()
    {
        $validationRules = [
            'do' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ["regexp" => "/^(add_into_cart|update_cart|purge_cart)$/"]
            ],
            'id' => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 0]
            ],
            'kolicina' => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 0]
            ]
        ];
        $data = filter_input_array(INPUT_POST, $validationRules);

        switch ($data["do"]) {
            case "add_into_cart":
                try {
                    $izdelek = IzdelekDB::get($data);

                    if (isset($_SESSION["cart"][$data["id"]])) {
                        $_SESSION["cart"][$data["id"]]++;
                    } else {
                        $_SESSION["cart"][$data["id"]] = 1;
                    }
                    header("Status: 200");
                } catch (Exception $exc) {
                    die($exc->getMessage());
                }
                break;
            case "update_cart":
                if (isset($_SESSION["cart"][$data["id"]])) {
                    if ($data["kolicina"] > 0) {
                        $_SESSION["cart"][$data["id"]] = $data["kolicina"];
                    } else {
                        unset($_SESSION["cart"][$data["id"]]);
                    }
                }
                break;
            case "purge_cart":
                unset($_SESSION["cart"]);
                break;
            default:
                break;
        }
    }


}
