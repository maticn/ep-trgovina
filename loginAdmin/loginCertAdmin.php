<?php
/**
 * Created by PhpStorm.
 * User: ep
 * Date: 07.01.2015
 * Time: 20:37
 */

session_start();
echo "Certifikat administratorja sprejet.";
$_SESSION["certRole"] = 1;
header("refresh:2;url=../login");
exit;
