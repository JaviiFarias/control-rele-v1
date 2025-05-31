<?php

$dbhost = 'localhost';
$dbuser = 'c2761373_miiotdb';
$dbpass = 'pubo17DAvu';
$dbname = 'c2761373_miiotdb';

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}
?>
