<?php

require_once("model/BookDB.php");
require_once("ViewHelper.php");
require_once("forms/BooksForm.php");

class BooksController {

    public static function index() {
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
            echo ViewHelper::render("view/book-list.php", [
                "books" => BookDB::getAll()
            ]);
        }
    }

    public static function add() {
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
