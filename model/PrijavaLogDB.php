<?php

require_once 'model/AbstractDB.php';

class UporabnikDB extends AbstractDB
{

    public static function insert(array $uporabnikId)
    {
        return parent::modify("INSERT INTO PrijavaLog (idUporabnik, casPrijave) "
            . " VALUES (:idUporabnik, now())", ["idUporabnik" => $uporabnikId]);
    }

    public static function update(array $params)
    {
    }

    public static function delete(array $id)
    {
        return parent::modify("DELETE FROM Uporabnik WHERE idUporabnik = :id", $id);
    }

    public static function get(array $id)
    {
        $books = parent::query("SELECT ime, priimek, email, geslo, idVloga, telefon, naslov, datumRegistracije, aktivno"
            . " FROM Uporabnik"
            . " WHERE id = :id", $id);

        if (count($books) == 1) {
            return $books[0];
        } else {
            throw new InvalidArgumentException("No such book");
        }
    }

    public static function getAll()
    {
        return parent::query("SELECT ime, priimek, email, geslo, idVloga, telefon, naslov, datumRegistracije, aktivno"
            . " FROM Uporabnik"
            . " ORDER BY id ASC");
    }

}
