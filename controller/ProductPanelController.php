<?php

require_once("model/IzdelekDB.php");
require_once("ViewHelper.php");
require_once("forms/IzdelekForm.php");

class ProductPanelController
{

    public static function panel()
    {
        $izdelki = IzdelekDB::getAll();
        foreach ($izdelki as &$izdelek) {
            $izdelek["slike"] = SlikaIzdelkaDB::get($izdelek);
        }
        echo ViewHelper::render("view/productpanel.php", [
            "izdelki" => $izdelki
        ]);

    }

    public static function add()
    {
        $form = new IzdelekInsertForm("add_form");

        if ($form->isSubmitted() && $form->validate()) {
            $id = IzdelekDB::insert(array_merge(
                $form->getValue(), ["aktivno" => 1]
            ));
            ViewHelper::redirect(BASE_URL . "store");
        } else {
            echo ViewHelper::render("view/izdelek-form.php", [
                "form" => $form,
                "title" => "Dodaj izdelek"
            ]);
        }
    }

    public static function edit()
    {
        $editForm = new IzdelekEditForm("edit_form");
        $rules = [
            "id" => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 1]
            ]
        ];

        $GET_data = filter_input_array(INPUT_GET, $rules);

        if ($editForm->isSubmitted()) {
            if ($editForm->validate()) {
                $data = $editForm->getValue();
                $data["idIzdelek"] = $GET_data["id"];
                if (!isset($data["aktivno"]))
                    $data["aktivno"] = 0;
                IzdelekDB::update($data);
                ViewHelper::redirect(BASE_URL . "productpanel");
            } else {
                echo ViewHelper::render("view/izdelek-form.php", [
                    "title" => "Urejanje izdelka",
                    "form" => $editForm,
                ]);
            }
        } else {

            if ($GET_data["id"]) {
                $izdelek = IzdelekDB::get($GET_data);
                $dataSource = new HTML_QuickForm2_DataSource_Array($izdelek);
                $editForm->addDataSource($dataSource);

                echo ViewHelper::render("view/izdelek-form.php", [
                    "title" => "Urejanje izdelka",
                    "form" => $editForm,
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
