<?php

require_once 'model/AbstractDB.php';

class SlikaIzdelkaDB extends AbstractDB {

    public static function insert(array $params) {
        return parent::modify("INSERT INTO SlikaIzdelka (idIzdelek, slika) "
            . " VALUES (:idIzdelek, :slika)", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE SlikaIzdelka SET idIzdelek = :idIzdelek, slika = :slika"
            . " WHERE idSlikaIzdelka = :idSlikaIzdelka", $params);
    }

    public static function delete(array $params) {
        return parent::modify("DELETE FROM SlikaIzdelka WHERE idSlikaIzdelka = :idSlikaIzdelka", $params);
    }

    public static function get(array $params) {
        $slike = parent::query("SELECT idIzdelek, slika"
            . " FROM SlikaIzdelka"
            . " WHERE idSlikaIzdelka = :idSlikaIzdelka", $params);

        if (count($slike) == 1) {
            return $slike[0];
        } else {
            throw new InvalidArgumentException("Slika ne obstaja.");
        }
    }

    public static function getAll() {
        return parent::query("SELECT idSlikaIzdelka, idIzdelek, slika"
            . " FROM SlikaIzdelka"
            . " ORDER BY idSlikaIzdelka ASC");
    }

}
