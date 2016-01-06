<?php

require_once("model/IzdelekDB.php");
require_once("ViewHelper.php");
require_once("forms/IzdelekForm.php");

class ProductPanelController {

    public static function panel() {
        $rules = [
            "id" => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 1]
            ]
        ];

        $data = filter_input_array(INPUT_GET, $rules);

        if ($data["id"]) {
            echo ViewHelper::render("view/book-detail.php", [
                "book" => BookDB::get($data)
            ]);
        } else {
            $izdelki = IzdelekDB::getAll();
            foreach ($izdelki as &$izdelek){
                $izdelek["slike"] = SlikaIzdelkaDB::get($izdelek);
            }
            echo ViewHelper::render("view/productpanel.php", [
                "izdelki" => $izdelki
            ]);
        }
    }

    public static function add() {
        $form = new IzdelekInsertForm("add_form");

        if ($form->isSubmitted() && $form->validate()) {
            $id = IzdelekDB::insert(array_merge(
                $form->getValue(), ["aktivno" => 1]
            ));
            ViewHelper::redirect(BASE_URL . "store");
        } else {
            echo ViewHelper::render("view/izdelek-add.php", [
                "form" => $form
            ]);
        }
    }

    public static function edit() {
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

    public static function delete() {
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
