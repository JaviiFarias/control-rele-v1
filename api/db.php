<?php

$dbhost = '';
$dbuser = '';
$dbpass = '';
$dbname = '';

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}
?>
