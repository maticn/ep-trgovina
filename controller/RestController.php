<?php
/**
 * Created by PhpStorm.
 * User: ep
 * Date: 11.1.2016
 * Time: 9:06
 */

header('Content-Type: application/json');

$izdelki = IzdelekDB::getAll();
echo json_encode($izdelki);
