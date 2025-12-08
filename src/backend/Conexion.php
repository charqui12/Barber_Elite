<?php 
class Conexion {
    private $servidor = "localhost";
    private $base = "barberia";
    private $usuario = "root";
    private $password = "root2024";
    public $enlace = null;


    public function conectar() {
        $this->enlace = mysqli_connect($this->servidor, $this->usuario, $this->password, $this->base);
        if (!$this->enlace) {
            throw new Exception("No se pudo conectar a la base de datos: " . mysqli_connect_error());
        }
        return $this->enlace;
    }

    // Insertar cita en la base de datos
    public function insertarCita($nombre, $correo, $telefono, $fecha_hora, $servicio) {
        if ($this->enlace == null) {
            $this->conectar();
        }
        $stmt = $this->enlace->prepare(
            "INSERT INTO citas (nombre, correo, telefono, fecha_hora, servicio) VALUES (?, ?, ?, ?, ?)"
        );
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta insertarCita: " . $this->enlace->error);
        }
        $stmt->bind_param("sssss", $nombre, $correo, $telefono, $fecha_hora, $servicio);
        if (!$stmt->execute()) {
            throw new Exception("Error al ejecutar la consulta insertarCita: " . $stmt->error);
        }
        $stmt->close();
        return true;
    }

    public function obtenerCitas() {
        if ($this->enlace == null) {
            $this->conectar();
        }
        $query = "SELECT * FROM citas ORDER BY fecha_hora";
        $result = mysqli_query($this->enlace, $query);
        if (!$result) {
            throw new Exception("Error al obtener citas: " . mysqli_error($this->enlace));
        }
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function __destruct() {
        if ($this->enlace != null) {
            mysqli_close($this->enlace);
        }
    }
}
?>
