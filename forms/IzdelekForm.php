<?php

require_once 'HTML/QuickForm2.php';
require_once 'HTML/QuickForm2/Container/Fieldset.php';
require_once 'HTML/QuickForm2/Element/InputSubmit.php';
require_once 'HTML/QuickForm2/Element/InputText.php';
require_once 'HTML/QuickForm2/Element/Textarea.php';
require_once 'HTML/QuickForm2/Element/InputCheckbox.php';
require_once 'HTML/QuickForm2/Element/InputFile.php';

abstract class IzdelekAbstractForm extends HTML_QuickForm2 {

    public $ime;
    public $opis;
    public $cena;

    public function __construct($id) {
        parent::__construct($id, "post", ["action" => BASE_URL."addproduct"]);
        $this->setAttribute('class','form form-qf2');

        $this->ime = new HTML_QuickForm2_Element_InputText('ime');
        $this->ime->setAttribute('size', 70);
        $this->ime->setLabel('Ime');
        $this->ime->setAttribute('class','form-control');
        $this->ime->addRule('required', 'Vnesi ime izdelka.');
        $this->ime->addRule('regex', 'Letters only.', '/^[a-zA-ZščćžŠČĆŽ ]+$/');
        $this->addElement($this->ime);

        $this->cena = new HTML_QuickForm2_Element_InputText('cena');
        $this->cena->setAttribute('size', 10);
        $this->cena->setLabel('Cena (v €)');
        $this->cena->setAttribute('class','form-control');
        $this->cena->addRule('required', 'Cena je obvezna.');
        $this->cena->addRule('callback', 'Cena mora biti število.', array(
                'callback' => 'filter_var',
                'arguments' => [FILTER_VALIDATE_FLOAT]
            )
        );
        $this->addElement($this->cena);

        $this->opis = new HTML_QuickForm2_Element_Textarea('opis');
        $this->opis->setAttribute('rows', 10);
        $this->opis->setAttribute('class','form-control');
        $this->opis->setAttribute('cols', 70);
        $this->opis->setLabel('Opis izdelka');
        $this->opis->addRule('required', 'Opis izdelka je obvezen.');
        $this->addElement($this->opis);

        $this->button = new HTML_QuickForm2_Element_InputSubmit(null);
        $this->button->setAttribute('class','btn btn-success');
        $this->addElement($this->button);

        $this->addRecursiveFilter('trim');
        $this->addRecursiveFilter('htmlspecialchars');
    }

}

class IzdelekInsertForm extends IzdelekAbstractForm {

    public function __construct($id) {
        parent::__construct($id);

        $this->button->setAttribute('value', 'Dodaj izdelek');
    }

}

//class BooksEditForm extends BooksAbstractForm {
//
//    public $id;
//
//    public function __construct($id) {
//        parent::__construct($id);
//
//        $this->button->setAttribute('value', 'Edit book');
//        $this->id = new HTML_QuickForm2_Element_InputHidden("id");
//        $this->addElement($this->id);
//    }
//
//}
//
//class BooksDeleteForm extends HTML_QuickForm2 {
//
//    public $id;
//
//    public function __construct($id) {
//        parent::__construct($id, "post", ["action" => BASE_URL . "books/delete"]);
//
//        $this->id = new HTML_QuickForm2_Element_InputHidden("id");
//        $this->addElement($this->id);
//
//        $this->confirmation = new HTML_QuickForm2_Element_InputCheckbox("confirmation");
//        $this->confirmation->setLabel('Delete?');
//        $this->confirmation->addRule('required', 'Tick if you want to delete book.');
//        $this->addElement($this->confirmation);
//
//        $this->button = new HTML_QuickForm2_Element_InputSubmit(null);
//        $this->button->setAttribute('value', 'Delete book');
//        $this->addElement($this->button);
//    }
//
//}
