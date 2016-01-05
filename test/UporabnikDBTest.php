<?php
require 'model/UporabnikDB.php';

UporabnikDB::insert(
    [
        "ime" => "Administrator", "priimek" => "Veliki", "email" => "info@makro.si", "geslo" => "Test123!", "idVloga" => 1,
        "telefon" => "041 000 000"
    ]
);
//UporabnikDB::updateAktivno(["idUporabnik" => 13,"aktivno" =>1]);
//var_dump(UporabnikDB::get(["id"=>13]));

//UporabnikDB::getUser(
//    [
//        "email" => "info@makro.si"
//    ]
//);