<?php
require_once 'db.php';

if (isset($_GET['estado'])) {
    $estado = $_GET['estado'];

    if ($estado === 'ON' || $estado === 'OFF') {
        $stmt = $conn->prepare("UPDATE rele_estado SET estado = ? WHERE id = 1");
        $stmt->bind_param("s", $estado);
        if ($stmt->execute()) {
            echo "OK";
        } else {
            http_response_code(500);
            echo "ERROR AL ACTUALIZAR";
        }
        $stmt->close();
    } else {
        http_response_code(400);
        echo "ESTADO INVALIDO";
    }
} else {
    http_response_code(400);
    echo "FALTA PARAMETRO 'estado'";
}
?>
