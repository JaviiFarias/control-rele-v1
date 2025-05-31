<?php
// index.php
$api_base_url = "";

function apiGetEstado($url) {
    $response = @file_get_contents($url . "/get_estado.php");
    return $response === FALSE ? "ERROR" : trim($response);
}

function apiSetEstado($url, $nuevoEstado) {
    $response = @file_get_contents($url . "/set_estado.php?estado=" . $nuevoEstado);
    return $response === FALSE ? "ERROR" : trim($response);
}

$estado = apiGetEstado($api_base_url);

if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
    if ($accion === 'ON' || $accion === 'OFF') {
        $resultado = apiSetEstado($api_base_url, $accion);
        if ($resultado === "OK") {
            $estado = $accion;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Control de Relé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f0f2f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            max-width: 400px;
            width: 100%;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 12px;
        }
        .card-header {
            font-weight: 600;
            font-size: 1.25rem;
            background-color: #0d6efd;
            color: white;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .btn-lg {
            min-width: 120px;
        }
        .card-footer {
            font-size: 0.9rem;
            color: #6c757d;
            text-align: center;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header text-center">
            Estado actual del relé
        </div>
        <div class="card-body text-center">
            <h2 class="card-title mb-4">
                <?php
                    if ($estado === "ON") {
                        echo '<span class="badge bg-danger">APAGADO</span>';
                    } elseif ($estado === "OFF") {
                        echo '<span class="badge bg-success">PRENDIDO</span>';
                    } else {
                        echo '<span class="badge bg-secondary">DESCONOCIDO</span>';
                    }
                ?>
            </h2>
            <a href="?accion=ON" class="btn btn-danger btn-lg mx-2">Apagar</a>
            <a href="?accion=OFF" class="btn btn-success btn-lg mx-2">Prender</a>
        </div>
        <div class="card-footer">
            Última actualización: <?php echo date('Y-m-d H:i:s'); ?>
        </div>
    </div>
</body>
</html>
