<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require $root.'/model/UporabnikDB.php';

UporabnikDB::insert(
    [
        "ime" => "Miha", "priimek" => "Robic", "email" => "miha@gmail.com", "geslo" => "fizikajezakon", "idVloga" => 1,
        "telefon" => "031123456"
    ]
);