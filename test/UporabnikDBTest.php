<?php
require 'model/UporabnikDB.php';

//UporabnikDB::insert(
//    [
//        "ime" => "Miha", "priimek" => "Robic", "email" => "miha@gmail.com", "geslo" => "Test123!", "idVloga" => 1,
//        "telefon" => "031123456"
//    ]
//);

UporabnikDB::getUser(
    [
        "email" => "info@makro.si"
    ]
);