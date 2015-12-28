<?php

require_once 'model/AbstractDB.php';

class BookDB extends AbstractDB {

    public static function insert(array $params) {
        return parent::modify("INSERT INTO book (author, title, description, price, year) "
                        . " VALUES (:author, :title, :description, :price, :year)", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE book SET author = :author, title = :title, "
                        . "description = :description, price = :price, year = :year"
                        . " WHERE id = :id", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM book WHERE id = :id", $id);
    }

    public static function get(array $id) {
        $books = parent::query("SELECT id, author, title, description, price, year"
                        . " FROM book"
                        . " WHERE id = :id", $id);
        
        if (count($books) == 1) {
            return $books[0];
        } else {
            throw new InvalidArgumentException("No such book");
        }
    }

    public static function getAll() {
        return parent::query("SELECT id, author, title, price, year, description"
                        . " FROM book"
                        . " ORDER BY id ASC");
    }

}
