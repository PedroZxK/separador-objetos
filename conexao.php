<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_prod";

$mysqli = new mysqli($hostname, $username, $password, $database);

if ($mysqli->connect_error) {
    die('Erro na conexão: ' . $mysqli->connect_error);
}