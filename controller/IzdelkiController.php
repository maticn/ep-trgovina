<?php

require_once("model/IzdelekDB.php");
require_once("model/OcenaIzdelkaDB.php");
require_once("ViewHelper.php");


class IzdelkiController
{

    public static function index()
    {
        $data = filter_input_array(INPUT_GET);

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            // Iskanje
            $search = filter_input_array(INPUT_POST);
            $izdelki = IzdelekDB::iskanje($search);
            foreach ($izdelki as &$izdelek) {
                $izdelek["slike"] = SlikaIzdelkaDB::get($izdelek);
            }
            echo ViewHelper::render("view/izdelek-list.php", [
                "izdelki" => $izdelki
            ]);
        }


        if ($data["id"]) {
            $izdelek = IzdelekDB::get($data);
            $izdelek["slike"] = SlikaIzdelkaDB::get($izdelek);
            echo ViewHelper::render("view/izdelek-detail.php", [
                "izdelek" => $izdelek,
                "ocene" => OcenaIzdelkaDB::get(["idIzdelek" => $data["id"]])
            ]);
        } else {
            $izdelki = IzdelekDB::getAktivni();
            foreach ($izdelki as &$izdelek) {
                $izdelek["slike"] = SlikaIzdelkaDB::get($izdelek);
            }
            echo ViewHelper::render("view/izdelek-list.php", [
                "izdelki" => $izdelki
            ]);
        }
    }

    public static function oceni()
    {
        if (!isset($_SESSION["idUporabnik"])) {
            header("Location:" . BASE_URL . "login");
        }
        $validationRules = [
            'id' => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 1]
            ],
            'ocena' => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 1, "max_range" => 5]
            ]
        ];
        $data = filter_input_array(INPUT_POST, $validationRules);
        try {
            $izdelek = IzdelekDB::get($data); // Izdelek mora obstajati
            OcenaIzdelkaDB::insertOrUpdate([
                    "idUporabnik" => $_SESSION["idUporabnik"],
                    "idIzdelek" => $data["id"],
                    "ocena" => $data["ocena"]
                ]
            );
            header("Location:" . BASE_URL . "store?id=" . $data["id"]);
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }

//    public static function rest()
//    {
//        header('Content-Type: application/json');
//        $izdelki = IzdelekDB::getAll();
//        foreach ($izdelki as $_ => &$izdelek) {
//            $izdelek["slike"] = SlikaIzdelkaDB::get($izdelek);
//        }
//        echo json_encode($izdelki);
//    }


    public static function add()
    {
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

    public static function edit()
    {
        $editForm = new BooksEditForm("edit_form");
        $deleteForm = new BooksDeleteForm("delete_form");

        if ($editForm->isSubmitted()) {
            if ($editForm->validate()) {
                $data = $editForm->getValue();
                BookDB::update($data);
                ViewHelper::redirect(BASE_URL . "books?id=" . $data["id"]);
            } else {
                echo ViewHelper::render("view/book-form.php", [
                    "title" => "Edit book",
                    "form" => $editForm,
                    "deleteForm" => $deleteForm
                ]);
            }
        } else {
            $rules = [
                "id" => [
                    'filter' => FILTER_VALIDATE_INT,
                    'options' => ['min_range' => 1]
                ]
            ];

            $data = filter_input_array(INPUT_GET, $rules);

            if ($data["id"]) {
                $book = BookDB::get($data);
                $dataSource = new HTML_QuickForm2_DataSource_Array($book);
                $editForm->addDataSource($dataSource);
                $deleteForm->addDataSource($dataSource);

                echo ViewHelper::render("view/book-form.php", [
                    "title" => "Edit book",
                    "form" => $editForm,
                    "deleteForm" => $deleteForm
                ]);
            } else {
                throw new InvalidArgumentException("editing nonexistent entry");
            }
        }
    }

    public static function delete()
    {
        $form = new BooksDeleteForm("delete_form");
        $data = $form->getValue();

        if ($form->isSubmitted() && $form->validate()) {
            BookDB::delete($data);
            ViewHelper::redirect(BASE_URL . "books");
        } else {
            if (isset($data["id"])) {
                $url = BASE_URL . "books/edit?id=" . $data["id"];
            } else {
                $url = BASE_URL . "books";
            }

            ViewHelper::redirect($url);
        }
    }

}
