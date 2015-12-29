<?php

require_once 'model/AbstractDB.php';

class PostaDB extends AbstractDB
{

    public static function insert(array $params)
    {
        return parent::modify("INSERT INTO Posta (postnaSt, imePoste) "
            . " VALUES (:postnaSt, :imePoste)", $params);
    }

    public static function update(array $params)
    {
        return parent::modify("UPDATE Posta SET imePoste = :imePoste"
            . " WHERE postnaSt = :postnaSt", $params);
    }

    public static function delete(array $params)
    {
        return parent::modify("DELETE FROM Posta WHERE postnaSt = :postnaSt", $params);
    }

    public static function get(array $params)
    {
        $books = parent::query("SELECT postnaSt,imePoste"
            . " FROM Posta"
            . " WHERE postnaSt = :postnaSt", $params);

        if (count($books) == 1) {
            return $books[0];
        } else {
            throw new InvalidArgumentException("No such book");
        }
    }

    public static function getAll()
    {
        return parent::query("SELECT postnaSt, imePoste"
            . " FROM Posta"
            . " ORDER BY postnaSt ASC");
    }

}
