<?php
require_once "Conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $fecha = $_POST['fecha'] ?? '';
    $servicio = $_POST['servicio'] ?? '';

    try {
        $db = new Conexion();
        $db->insertarCita($nombre, $correo, $telefono, $fecha, $servicio);

        echo "<script>
                alert('Cita registrada correctamente');
                window.location.href='../frontend/index.html';
              </script>";

    } catch (Exception $e) {
        echo "<script>
                alert('Error al registrar la cita: " . $e->getMessage() . "');
                window.location.href='../frontend/index.html';
              </script>";
    }
}
?>
