<?php

require_once 'model/AbstractDB.php';

class NarociloDB extends AbstractDB {

    public static function insert(array $params) {
        $params["status"] = 1;
        return parent::modify("INSERT INTO Narocilo (cenaSkupaj, status, idStranke, datumOddaje, idProdajalca, datumPotrditve) "
            . " VALUES (:cenaSkupaj, :status, :idStranke, now(), :idProdajalca, :datumPotrditve)", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE Narocilo SET status = :status, idProdajalca = :idProdajalca, datumPotrditve = :datumPotrditve "
            . " WHERE idNarocilo = :idNarocilo", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM Uporabnik WHERE idUporabnik = :id", $id);
    }

    public static function get(array $id) {
        $books = parent::query("SELECT ime, priimek, email, geslo, idVloga, telefon, naslov, datumRegistracije, aktivno"
            . " FROM Uporabnik"
            . " WHERE id = :id", $id);

        if (count($books) == 1) {
            return $books[0];
        } else {
            throw new InvalidArgumentException("No such book");
        }
    }

    public static function getAll() {
        return parent::query("SELECT ime, priimek, email, geslo, idVloga, telefon, naslov, datumRegistracije, aktivno"
            . " FROM Uporabnik"
            . " ORDER BY id ASC");
    }

}
