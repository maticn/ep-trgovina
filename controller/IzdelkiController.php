<?php

require_once("model/IzdelekDB.php");
require_once("ViewHelper.php");


class IzdelkiController
{

    public static function index()
    {
        $data = filter_input_array(INPUT_GET);

        if ($data["id"]) {
            echo ViewHelper::render("view/izdelek-detail.php", [
                "izdelek" => IzdelekDB::get($data)
            ]);
        } else {
            echo ViewHelper::render("view/izdelek-list.php", [
                "izdelki" => IzdelekDB::getAll()
            ]);
        }
    }

    public static function cart()
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
                    $knjiga = BazaKnjig::vrniKnjigo($data["id"]);

                    if (isset($_SESSION["cart"][$knjiga->id])) {
                        $_SESSION["cart"][$knjiga->id]++;
                    } else {
                        $_SESSION["cart"][$knjiga->id] = 1;
                    }
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
