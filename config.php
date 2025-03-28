<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/medisep/includes/functions_incl.php');

loadEnv4DB(__DIR__.'/.env');

$servername = $_ENV['DB_HOST'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_DATABASE'];

define('BASEURL', $_ENV['BASEURL']);

$title = "SERP | MEDISEP - "
.ucwords(str_ireplace(array(BASEURL,'.php', '_', 'index', '/'), array('', '', ' ', 'dashboard', ' '), 'https://'.$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"]));
$erp_version="Version 2.1.6";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
