<?php
require 'model/PrijavaLogDB.php';

PrijavaLogDB::insert(
    ["idUporabnik" => 1]
);
var_dump(PrijavaLogDB::getAll());