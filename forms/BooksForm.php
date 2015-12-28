<?php

require_once 'HTML/QuickForm2.php';
require_once 'HTML/QuickForm2/Container/Fieldset.php';
require_once 'HTML/QuickForm2/Element/InputSubmit.php';
require_once 'HTML/QuickForm2/Element/InputText.php';
require_once 'HTML/QuickForm2/Element/Textarea.php';
require_once 'HTML/QuickForm2/Element/InputCheckbox.php';

abstract class BooksAbstractForm extends HTML_QuickForm2 {

    public $author;
    public $title;
    public $price;
    public $year;
    public $description;
    public $button;

    public function __construct($id) {
        parent::__construct($id);

        $this->author = new HTML_QuickForm2_Element_InputText('author');
        $this->author->setAttribute('size', 70);
        $this->author->setLabel('Author');
        $this->author->addRule('required', 'Provide author\'s name.');
        $this->author->addRule('regex', 'Letters only.', '/^[a-zA-ZščćžŠČĆŽ ]+$/');
        $this->addElement($this->author);

        $this->title = new HTML_QuickForm2_Element_InputText('title');
        $this->title->setAttribute('size', 70);
        $this->title->setLabel('Book title:');
        $this->title->addRule('required', 'Title is mandatory.');
        $this->title->addRule('regex', 'Letters only.', '/^[a-zA-ZščćžŠČĆŽ ]+$/');
        $this->title->addRule('maxlength', 'Should be shorter than 255 characters.', 255);
        $this->addElement($this->title);

        $this->price = new HTML_QuickForm2_Element_InputText('price');
        $this->price->setAttribute('size', 10);
        $this->price->setLabel('Price:');
        $this->price->addRule('required', 'Price is mandatory.');
        $this->price->addRule('callback', 'Price should be a valid number.', array(
            'callback' => 'filter_var',
            'arguments' => [FILTER_VALIDATE_FLOAT]
                )
        );
        $this->addElement($this->price);

        $this->year = new HTML_QuickForm2_Element_InputText('year');
        $this->year->setAttribute('size', 10);
        $this->year->setLabel('Year:');
        $this->year->addRule('required', 'Year is mandatory.');
        $this->year->addRule('gte', 'Year must be above 1800', 1800);
        $this->year->addRule('lte', 'Year must be below ' . date("Y"), date("Y"));
        $this->addElement($this->year);

        $this->description = new HTML_QuickForm2_Element_Textarea('description');
        $this->description->setAttribute('rows', 10);
        $this->description->setAttribute('cols', 70);
        $this->description->setLabel('Book description');
        $this->description->addRule('required', 'Provide some text.');
        $this->addElement($this->description);

        $this->button = new HTML_QuickForm2_Element_InputSubmit(null);
        $this->addElement($this->button);

        $this->addRecursiveFilter('trim');
        $this->addRecursiveFilter('htmlspecialchars');
    }

}

class BooksInsertForm extends BooksAbstractForm {

    public function __construct($id) {
        parent::__construct($id);

        $this->button->setAttribute('value', 'Add book');
    }

}

class BooksEditForm extends BooksAbstractForm {

    public $id;

    public function __construct($id) {
        parent::__construct($id);

        $this->button->setAttribute('value', 'Edit book');
        $this->id = new HTML_QuickForm2_Element_InputHidden("id");
        $this->addElement($this->id);
    }

}

class BooksDeleteForm extends HTML_QuickForm2 {

    public $id;

    public function __construct($id) {
        parent::__construct($id, "post", ["action" => BASE_URL . "books/delete"]);

        $this->id = new HTML_QuickForm2_Element_InputHidden("id");
        $this->addElement($this->id);

        $this->confirmation = new HTML_QuickForm2_Element_InputCheckbox("confirmation");
        $this->confirmation->setLabel('Delete?');
        $this->confirmation->addRule('required', 'Tick if you want to delete book.');
        $this->addElement($this->confirmation);
        
        $this->button = new HTML_QuickForm2_Element_InputSubmit(null);
        $this->button->setAttribute('value', 'Delete book');
        $this->addElement($this->button);
    }

}
