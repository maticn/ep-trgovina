<?php

require_once 'model/AbstractDB.php';

class PrijavaLogDB extends AbstractDB
{

    public static function insert(array $params)
    {
        return parent::modify("INSERT INTO PrijavaLog (idUporabnik, casPrijave) "
            . " VALUES (:idUporabnik, now())", $params);
    }

    public static function update(array $params)
    {
    }

    public static function delete(array $id)
    {
        return parent::modify("DELETE FROM PrijavaLog WHERE idPrijavaLog = :id", $id);
    }

    public static function get(array $id)
    {
        $books = parent::query("SELECT idUporabnika,casPrijave"
            . " FROM PrijavaLog"
            . " WHERE id = :id", $id);

        if (count($books) == 1) {
            return $books[0];
        } else {
            throw new InvalidArgumentException("No such book");
        }
    }

    public static function getAll()
    {
        return parent::query("SELECT idPrijavaLog, idUporabnik, casPrijave"
            . " FROM PrijavaLog"
            . " ORDER BY idPrijavaLog ASC");
    }

}
