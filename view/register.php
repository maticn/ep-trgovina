<?php
/**
 * Created by PhpStorm.
 * User: ep
 * Date: 5.1.2016
 * Time: 8:38
 */

require_once(dirname(__FILE__)."/lib/database.php");

session_start();

// preveri ce obstaja userid v $_SESSION

$db = new dbConnector();
$db->dbOpen();

// register new buyer
$sql = "INSERT INTO users (type, active,";
/* INSERT INTO users (firstname, lastname, username, EMSO, password, type, active)
VALUES (:fname, :lname, :username, :emso, :pwd, 'seller', '1' )"*/
$params = array();
if (isset($_POST["password"]) && $_POST["password"] === $_POST["confirm"] && !empty($_POST["password"])) {
    $sql .= "password,";
    $params[] = sha1(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));
}
if (isset($_POST["firstname"]) && !empty($_POST["firstname"])) {
    $sql .= "firstname,";
    $params[] = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
}
if (isset($_POST["address"]) && !empty($_POST["address"])) {
    $sql .= "address,";
    $params[] = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS);
}
if (isset($_POST["username"]) && !empty($_POST["username"])) {
    $sql .= "username,";
    $params[] = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
}
if (isset($_POST["lastname"]) && !empty($_POST["lastname"])) {
    $sql .= "lastname,";
    $params[] = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
}
if (isset($_POST["email"]) && !empty($_POST["email"])) {
    $sql .= "email,";
    $params[] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
}
if (isset($_POST["post"]) && !empty($_POST["post"])) {
    $sql .= "post,";
    $params[] = filter_input(INPUT_POST, 'post', FILTER_SANITIZE_SPECIAL_CHARS);
}
if (isset($_POST["city"]) && !empty($_POST["city"])) {
    $sql .= "city,";
    $params[] = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);
}
if (isset($_POST["country"]) && !empty($_POST["country"])) {
    $sql .= "country,";
    $params[] = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_SPECIAL_CHARS);
}
if (isset($_POST["phone"]) && !empty($_POST["phone"])) {
    $sql .= "phone_number,";
    $params[] = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
}
$sql = trim($sql, ",");
$sql .= ") VALUES ('buyer', '0',";

foreach ($params as $k) {
    $sql .= "?,";
}
$sql = trim($sql, ",");
$sql .= ")";

$db->execute($sql, $params);

$db->dbClose();
header("Location:login.html");
exit;


?>