<?php
require 'model/UporabnikDB.php';

UporabnikDB::insert(
    [
        "ime" => "Miha", "priimek" => "Robic", "email" => "miha@gmail.com", "geslo" => "fizikajezakon", "idVloga" => 1,
        "telefon" => "031123456"
    ]
);