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
        return parent::query("SELECT u.ime, o.idUporabnik, o.idIzdelek, o.ocena"
            . " FROM OcenaIzdelka o, Uporabnik u"
            . " WHERE o.idIzdelek = :idIzdelek AND u.idUporabnik = o.idUporabnik", $params);

    }

    public static function insertOrUpdate(array $params)
    {
        return parent::modify("INSERT INTO OcenaIzdelka (idUporabnik, idIzdelek, ocena) "
            . "VALUES (:idUporabnik, :idIzdelek, :ocena)"
            . "ON DUPLICATE KEY UPDATE ocena=:ocena", $params);

    }

    public static function getAll()
    {
        return parent::query("SELECT idUporabnik, idIzdelek, ocena"
            . " FROM OcenaIzdelka"
            . " ORDER BY idUporabnik ASC");
    }

}
