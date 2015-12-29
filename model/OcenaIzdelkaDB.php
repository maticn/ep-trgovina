<?php

require_once 'model/AbstractDB.php';

class OcenaIzdelkaDB extends AbstractDB
{

    public static function insert(array $params)
    {
        return parent::modify("INSERT INTO OcenaIzdelka (idUporabnik, idIzdelek, ocena) "
            . " VALUES (:idUporabnik, :idIzdelek, :ocena)", $params);
    }

    public static function update(array $params)
    {
        return parent::modify("UPDATE OcenaIzdelka SET ocena = :ocena"
            . " WHERE idUporabnik = :idUporabnik AND idIzdelek = :idIzdelek", $params);
    }

    public static function delete(array $params)
    {
        return parent::modify("DELETE FROM OcenaIzdelka WHERE idUporabnik = :idUporabnik AND idIzdelek = :idIzdelek", $params);
    }

    public static function get(array $params)
    {
        $books = parent::query("SELECT idUporabnik, idIzdelek, ocena"
            . " FROM OcenaIzdelka"
            . " WHERE idIzdelek = :idIzdelek", $params);

        if (count($books) == 1) {
            return $books[0];
        } else {
            throw new InvalidArgumentException("No such book");
        }
    }

    public static function getAll()
    {
        return parent::query("SELECT idUporabnik, idIzdelek, ocena"
            . " FROM OcenaIzdelka"
            . " ORDER BY idUporabnik ASC");
    }

}
