<?php
require_once("model/SlikaIzdelkaDB.php");

class SlikaController
{
    public static function controller()
    {
        if (!isset($_SESSION["idUporabnik"])) {
            header("Location:" . BASE_URL . "login");
            exit;
        }
        if ($_SESSION["idVloga"] == 3) {
            header('HTTP/1.1 401 Unauthorized', true, 401);
            echo "401 Unauthorized";
            exit;
        }
        $validationRules = ['do' =>
            [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ["regexp" => "/^(add|delete)$/"]
            ],
            'id' => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 0]
            ]
        ];
        $data = filter_input_array(INPUT_POST, $validationRules);


        switch ($data["do"]) {
            case "add":
                try {
                    $filename = $_FILES['slika']['name'];
                    $allowed = ['png', 'jpg', 'jpeg'];  //which file types are allowed seperated by comma

                    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
                    if (!array_search($file_extension, $allowed)) {
                        die("This file type is not allowed!");
                    }

                    $target_dir = SITE_ROOT . "/static/images/";
                    $target_file = $target_dir . basename($_FILES["slika"]["name"]);
                    move_uploaded_file($_FILES["slika"]["tmp_name"], $target_file);
                    SlikaIzdelkaDB::insert(["idIzdelek" => $data["id"], "slika" => $_FILES["slika"]["name"]]);
                    header("Location:" . BASE_URL . "productpanel");
                } catch (Exception $exc) {
                    die($exc->getMessage());
                }
                break;
            case "delete":
                try {

                    SlikaIzdelkaDB::delete(["idSlikaIzdelka" => $data["id"]]);
                    header("Location:" . BASE_URL . "productpanel");
                } catch (Exception $exc) {
                    die($exc->getMessage());
                }
                break;
            default:
                break;
        }
    }
}