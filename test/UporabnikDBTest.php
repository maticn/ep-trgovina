<?php
require 'model/UporabnikDB.php';

UporabnikDB::insert(
    [
        "ime" => "Stranka", "priimek" => "Muhic", "email" => "muhic@gmail.com", "geslo" => "Test123!", "idVloga" => 1,
        "telefon" => "041000000"
    ]
);

//UporabnikDB::getUser(
//    [
//        "email" => "info@makro.si"
//    ]
//);