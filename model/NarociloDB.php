<?php

require_once 'model/AbstractDB.php';

class NarociloDB extends AbstractDB {

    public static function insert(array $params) {
        $defaultVals = ["idProdajalca" => null, "datumPotrditve" => null];
        $params["status"] = 1;
        $params = array_merge($defaultVals, $params);
        return parent::modify("INSERT INTO Narocilo (cenaSkupaj, status, idStranke, datumOddaje, idProdajalca, datumPotrditve) "
            . " VALUES (:cenaSkupaj, :status, :idStranke, now(), :idProdajalca, :datumPotrditve)", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE Narocilo SET status = :status, idProdajalca = :idProdajalca, datumPotrditve = :datumPotrditve "
            . " WHERE idNarocilo = :idNarocilo", $params);
    }

    public static function updateStatus(array $params) {
        return parent::modify("UPDATE Narocilo SET status = :status"
            . " WHERE idNarocilo = :idNarocilo", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM Narocilo WHERE idNarocilo = :id", $id);
    }

    public static function get(array $id) {
        $narocila = parent::query("SELECT idNarocilo, cenaSkupaj, status, idStranke, datumOddaje, idProdajalca, datumPotrditve"
            . " FROM Narocilo"
            . " WHERE idNarocilo = :id", $id);

        if (count($narocila) == 1) {
            return $narocila[0];
        } else {
            throw new InvalidArgumentException("Narocilo ne obstaja.");
        }
    }

    public static function getAll() {
        return parent::query("SELECT idNarocilo, cenaSkupaj, status, idStranke, datumOddaje, idProdajalca, datumPotrditve"
            . " FROM Narocilo"
            . " ORDER BY idNarocilo ASC");
    }

}
