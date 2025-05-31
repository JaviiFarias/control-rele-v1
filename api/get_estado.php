<?php
require_once 'db.php';

$sql = "SELECT estado FROM rele_estado WHERE id = 1 LIMIT 1";
$resultado = $conn->query($sql);

if ($resultado && $fila = $resultado->fetch_assoc()) {
    echo $fila['estado']; 
} else {
    http_response_code(500);
    echo "ERROR";
}
?>
