<?php
/**
 * Created by PhpStorm.
 * User: ep
 * Date: 07.01.2015
 * Time: 20:37
 */

session_start();
echo "Certifikat prodajalca sprejet.";
$_SESSION["certRole"] = 2;
header("refresh:2;url=../login");
exit;