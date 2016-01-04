<?php

require_once 'model/AbstractDB.php';

class IzdelekDB extends AbstractDB {

    public static function insert(array $params) {
        return parent::modify("INSERT INTO Izdelek (ime, opis, cena, aktivno) "
            . " VALUES (:ime, :opis, :cena, :aktivno)", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE Izdelek SET ime = :ime, opis = :opis, cena = :cena, aktivno = :aktivno"
            . " WHERE idIzdelek = :idIzdelek", $params);
    }

    public static function delete(array $params) {
        return parent::modify("DELETE FROM Izdelek WHERE idIzdelek = :idIzdelek", $params);
    }

    public static function get(array $params) {
        $izdelki = parent::query("SELECT ime, opis, cena, aktivno"
            . " FROM Izdelek"
            . " WHERE idIzdelek = :id", $params);

        if (count($izdelki) == 1) {
            return $izdelki[0];
        } else {
            throw new InvalidArgumentException("Izdelek ne obstaja.");
        }
    }

    public static function getAll() {
        return parent::query("SELECT idIzdelek, ime, opis, cena, aktivno"
            . " FROM Izdelek"
            . " ORDER BY idIzdelek ASC");
    }

}
