<?php

require_once 'AbstractDB.php';

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
        $izdelki = parent::query("SELECT i.idIzdelek, i.ime, i.opis, i.cena, i.aktivno, AVG(o.ocena) AS avg_ocena, "
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
            . " FROM Izdelek i  LEFT JOIN OcenaIzdelka o"
            . " ON i.idIzdelek = o.idIzdelek GROUP BY i.idIzdelek");
    }

    public static function getAllRest()
    {
        return parent::query("SELECT idIzdelek, ime "
            . " FROM Izdelek i "
            . " WHERE i.aktivno = 1");
    }

    public static function iskanje(array $params)
    {
//SELECT * FROM articles WHERE MATCH (title,body)
//-> AGAINST ('+MySQL -YourSQL' IN BOOLEAN MODE);
        $i = $params["iskanje"];
        return parent::query("SELECT i.idIzdelek, i.ime, i.opis, i.cena, i.aktivno, AVG(o.ocena) AS avg_ocena, "
            . "COUNT(o.ocena) AS count_ocena"
            . " FROM Izdelek i  LEFT JOIN OcenaIzdelka o"
            . " ON i.idIzdelek = o.idIzdelek  WHERE i.aktivno=1 AND i.idIzdelek IN"
            . " (SELECT idIzdelek FROM Izdelek WHERE MATCH (ime,opis) AGAINST ('".$i."' IN BOOLEAN MODE))"
            . "GROUP BY i.idIzdelek", $params);


    }

    public static function getRest(array $params)
    {
        $izdelki = parent::query("SELECT i.idIzdelek, i.ime, i.opis, i.cena, AVG(o.ocena) AS avg_ocena, "
            . "COUNT(o.ocena) AS count_ocena"
            . " FROM Izdelek i, OcenaIzdelka o"
            . " WHERE i.idIzdelek = :id AND o.idIzdelek = i.idIzdelek AND i.Aktivno = 1 ", $params);

        if (count($izdelki) == 1) {
            return $izdelki[0];
        } else {
            throw new InvalidArgumentException("Izdelek ne obstaja.");
        }
    }

    public static function getAktivni()
    {
        return parent::query("SELECT i.idIzdelek, i.ime, i.opis, i.cena, i.aktivno, AVG(o.ocena) AS avg_ocena, "
            . "COUNT(o.ocena) AS count_ocena"
            . " FROM Izdelek i  LEFT JOIN OcenaIzdelka o"
            . " ON i.idIzdelek = o.idIzdelek  WHERE i.aktivno=1 GROUP BY i.idIzdelek");
    }

}
