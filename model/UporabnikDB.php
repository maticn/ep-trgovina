<?php

require_once 'model/AbstractDB.php';

class UporabnikDB extends AbstractDB {

    public static function insert(array $params) {
        $defaultVals = ["telefon" => null, "naslov" => null, "idPosta" => null];
        $params["aktivno"] = false;
        $params["geslo"] = password_hash($params["geslo"], PASSWORD_BCRYPT);
        //$params["geslo"] = SHA1($params["geslo"]);
        $params = array_merge($defaultVals, $params);
        //echo $params["idPosta"];
        return parent::modify("INSERT INTO Uporabnik (ime, priimek, email, geslo, idVloga, telefon, naslov, idPosta, datumRegistracije, aktivno) "
            . " VALUES (:ime, :priimek, :email, :geslo, :idVloga, :telefon, :naslov, :idPosta, now(), :aktivno)", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE Uporabnik SET ime = :ime, priimek = :priimek"
            . " WHERE idUporabnik = :idUporabnik", $params);
    }

    public static function updateStranka(array $params) {
        return parent::modify("UPDATE Uporabnik SET "
            . "telefon = :telefon, naslov = :naslov, idPosta = :idPosta"
            . " WHERE idUporabnik = :idUporabnik", $params);
    }

    public static function updatePass(array $params) {
        $params["geslo"] = SHA1($params["geslo"]);

        return parent::modify("UPDATE Uporabnik SET geslo = :geslo"
            . " WHERE idUporabnik = :idUporabnik", $params);
    }

    public static function updateVloga(array $params) {
        return parent::modify("UPDATE Uporabnik SET idVloga = :idVloga"
            . " WHERE idUporabnik = :idUporabnik", $params);
    }

    public static function updateAktivno(array $params) {
        return parent::modify("UPDATE Uporabnik SET aktivno = :aktivno"
            . " WHERE idUporabnik = :idUporabnik", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM Uporabnik WHERE idUporabnik = :id", $id);
    }

    public static function get(array $id) {
        $users = parent::query("SELECT ime, priimek, email, geslo, idVloga, telefon, naslov, idPosta, datumRegistracije, aktivno"
            . " FROM Uporabnik"
            . " WHERE idUporabnik = :id", $id);

        if (count($users) == 1) {
            return $users[0];
        } else {
            throw new InvalidArgumentException("Uporabnik ne obstaja.");
        }
    }

    public static function getUser(array $params) {
        $users = parent::query("SELECT idUporabnik, ime, priimek, email, geslo, idVloga, telefon, naslov, datumRegistracije, aktivno"
            . " FROM Uporabnik"
            . " WHERE email = :email AND aktivno = 1", $params);

        if (count($users) == 1) {
            return $users[0];
        } else {
            throw new InvalidArgumentException("Uporabnik ne obstaja.");
        }
    }

    public static function getCustomers() {
        return parent::query("SELECT idUporabnik, ime, priimek, email, telefon, naslov, idPosta, aktivno"
            . " FROM Uporabnik"
            . " WHERE idVloga = 3");
    }

    public static function getSellers() {
        return parent::query("SELECT idUporabnik, ime, priimek, email, aktivno"
            . " FROM Uporabnik"
            . " WHERE idVloga = 2");
    }

    public static function getAll() {
        return parent::query("SELECT ime, priimek, email, geslo, idVloga, telefon, naslov, datumRegistracije, aktivno"
            . " FROM Uporabnik"
            . " ORDER BY idUporabnik ASC");
    }

}
