<?php
require 'model/PostaDB.php';

//PostaDB::insert(["postnaSt"=>1000,"imePoste"=>"Ljubljana"]);
//PostaDB::insert(["postnaSt"=>8000,"imePoste"=>"Novo mesto"]);
var_dump(PostaDB::getAll());