<?php

require_once 'model/AbstractDB.php';

class IzdelekDB extends AbstractDB
{

    public static function insert(array $params)
    {
        return parent::modify("INSERT INTO Izdelek (ime, opis, cena, aktivno) "
            . " VALUES (:ime, :opis, :cena, :aktivno)", $params);
    }

    public static function update(array $params)
    {
        return parent::modify("UPDATE Izdelek SET ime = :ime, opis = :opis, cena = :cena, aktivno = :aktivno"
            . " WHERE idIzdelek = :idIzdelek", $params);
    }

    public static function delete(array $params)
    {
        return parent::modify("DELETE FROM Izdelek WHERE idIzdelek = :idIzdelek", $params);
    }

    public static function get(array $params)
    {
        $izdelki = parent::query("SELECT i.ime, i.opis, i.cena, i.aktivno, AVG(o.ocena) AS avg_ocena, "
            . "COUNT(o.ocena) AS count_ocena"
            . " FROM Izdelek i, OcenaIzdelka o"
            . " WHERE i.idIzdelek = :id AND o.idIzdelek = i.idIzdelek", $params);

        if (count($izdelki) == 1) {
            return $izdelki[0];
        } else {
            throw new InvalidArgumentException("Izdelek ne obstaja.");
        }
    }

    public static function getAll()
    {
        return parent::query("SELECT i.idIzdelek, i.ime, i.opis, i.cena, i.aktivno, AVG(o.ocena) AS avg_ocena, "
            . "COUNT(o.ocena) AS count_ocena"
            . " FROM Izdelek i, OcenaIzdelka o"
            . " WHERE o.idIzdelek = i.idIzdelek");
    }

}
