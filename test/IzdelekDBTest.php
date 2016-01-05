<?php
require 'model/IzdelekDB.php';

//IzdelekDB::insert(
//    [
//        "ime" => "klukec", "opis" => "Orodje za grobo obdelavo lesa.", "cena" => "49.56", "aktivno" => "1"
//    ]
//);

//IzdelekDB::update(
//    [
//        "idIzdelek" => "2", "ime" => "klukec", "opis" => "Orodje za grobo obdelavo lesa.", "cena" => "79.56", "aktivno" => "1"
//    ]
//);

//IzdelekDB::delete(
//    [
//        "idIzdelek" => "2"
//    ]
//);

//var_dump(IzdelekDB::get(
//    [
//        "id" => "1"
//    ]
//));

var_dump(IzdelekDB::getAll());
