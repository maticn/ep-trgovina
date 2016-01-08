<?php

require_once("model/NarociloDB.php");
require_once("model/UporabnikDB.php");
require_once("ViewHelper.php");

class NarocilaController
{
    public static $statusi = [
        1 => "Oddano",
        2 => "Potrjeno",
        3 => "Stornirano"
    ];

    public static function index()
    {
        $narocila = NarociloDB::getAll();
        foreach ($narocila as &$narocilo) {
            $narocilo["stranka"] = UporabnikDB::get(["id" => $narocilo["idStranke"]]);
            $narocilo["statusDisplay"] = NarocilaController::$statusi[$narocilo["status"]];
        }
        echo ViewHelper::render("view/narocila.php", [
            "narocila" => $narocila
        ]);
    }


    public static function akcije()
    {
        $validationRules = [
            'do' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ["regexp" => "/^(storniraj|potrdi)$/"]
            ],
            'id' => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 0]
            ]
        ];
        $data = filter_input_array(INPUT_POST, $validationRules);

        switch ($data["do"]) {
            case "storniraj":
                try {
                    $narocilo = NarociloDB::get($data);
                    // stranka lahko stornira samo svoja narocila
                    if ($_SESSION["idVloga"] == 3 && $narocilo["idStranka"] != $_SESSION["idUporabnik"]) {
                        die("Operacija ni dovoljena.");
                    }
                    NarociloDB::updateStatus(["idNarocilo" => $data["id"], "status" => 3]);

                    header("Location:" . BASE_URL . "narocila");
                } catch (Exception $exc) {
                    die($exc->getMessage());
                }
                break;
            case "potrdi":
                try {
                    $narocilo = NarociloDB::get($data);
                    // stranka ne more potrjevati naročil
                    if ($_SESSION["idVloga"] == 3) {
                        die("Operacija ni dovoljena.");
                    }
                    NarociloDB::updateStatus(["idNarocilo" => $data["id"], "status" => 2]);

                    header("Location:" . BASE_URL . "narocila");
                } catch (Exception $exc) {
                    die($exc->getMessage());
                }
                break;
            default:
                break;
        }
    }

}
