<?php

require_once("ViewHelper.php");
require_once("model/IzdelekDB.php");
require_once("model/NarociloDB.php");
require_once("model/PostavkaNarocilaDB.php");


class CartController
{
    private static function cenaSkupaj()
    {
        $cena = 0;
        if (!isset($_SESSION["cart"]))
            return 0;
        $vozick = $_SESSION["cart"];
        foreach ($vozick as $id => $kolicina) {
            $izdelek = IzdelekDB::get(["id" => $id]);
            $cena += $izdelek["cena"] * $kolicina;
        }
        return $cena;
    }

    public static function index()
    {
        $izdelki = [];
        if (isset($_SESSION["cart"])) {
            $vozick = $_SESSION["cart"];
            foreach ($vozick as $id => $kolicina) {
                $izdelki[] = array_merge(IzdelekDB::get(["id" => $id]), ["kolicina" => $kolicina]);
            }
        }

        echo ViewHelper::render("view/cart.php", ["izdelki" => $izdelki, "skupaj" => CartController::cenaSkupaj()]);
    }

    public static function ajax()
    {
        $validationRules = [
            'do' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ["regexp" => "/^(add_into_cart|vecvec|manjmanj|purge_cart)$/"]
            ],
            'id' => [
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
            case "vecvec": {
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
            }
                break;
            case "manjmanj": {
                try {
                    $izdelek = IzdelekDB::get($data);

                    if (isset($_SESSION["cart"][$data["id"]])) {
                        $_SESSION["cart"][$data["id"]]--;
                        if ($_SESSION["cart"][$data["id"]] == 0) {
                            unset($_SESSION["cart"][$data["id"]]);
                        }
                    }
                    header("Status: 200");
                } catch (Exception $exc) {
                    die($exc->getMessage());
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

    public static function oddajNarocilo()
    {
        // TODO
        $_SESSION["idUporabnik"] = 2;
        if (!isset($_SESSION["idUporabnik"])) {
            header("Location:store");
            exit;
        }
        $narociloId = NarociloDB::insert([
            "cenaSkupaj" => CartController::cenaSkupaj(),
            "idStranke" => $_SESSION["idUporabnik"]
        ]);
        foreach ($_SESSION["cart"] as $id => $kolicina) {
            PostavkaNarocilaDB::insert([
                "idNarocilo" => $narociloId,
                "idIzdelek" => $id,
                "kolicina" => $kolicina
            ]);
        }
        header("Location:".BASE_URL."narocila");
    }


}
