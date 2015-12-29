<?php

require_once 'model/AbstractDB.php';

class PostavkaNarocilaDB extends AbstractDB {

    public static function insert(array $params) {
        return parent::modify("INSERT INTO PostavkaNarocila (idNarocilo, idIzdelek, kolicina) "
            . " VALUES (:idNarocilo, :idIzelek, :kolicina", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE PostavkaNarocila SET kolicina = :kolicina"
            . " WHERE idNarocilo = :idNarocilo AND idIzdelek = :idIzdelek", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM PostavkaNarocila WHERE idNarocilo = :idNarocilo AND idIzdelek = :idIzdelek", $id);
    }

    public static function get(array $id) {
        $postavke = parent::query("SELECT idNarocilo, idIzdelek, kolicina"
            . " FROM PostavkaNarocila"
            . " WHERE idNarocilo = :idNarocilo AND idIzdelek = :idIzdelek", $id);

        if (count($postavke) == 1) {
            return $postavke[0];
        } else {
            throw new InvalidArgumentException("Postavka narocila ne obstaja.");
        }
    }

    public static function getAll() {
        return parent::query("SELECT idNarocilo, idIzdelek, kolicina"
            . " FROM PostavkaNarocila"
            . " ORDER BY idNarocilo ASC");
    }

}
