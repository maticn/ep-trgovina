<?php
require 'model/UporabnikDB.php';

//UporabnikDB::insert(
//    [
//        "ime" => "Stranka", "priimek" => "Mile", "email" => "mile@gmail.com", "geslo" => "bozic", "idVloga" => 1,
//        "telefon" => "041000000"
//    ]
//);
UporabnikDB::updateAktivno(["idUporabnik" => 13,"aktivno" =>1]);
var_dump(UporabnikDB::get(["id"=>13]));

//UporabnikDB::getUser(
//    [
//        "email" => "info@makro.si"
//    ]
//);