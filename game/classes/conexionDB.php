<?php

class ConexionDB
{
    private $host = "localhost";
    private $usuario = "root";
    private $contraseña = "";
    private $base_datos = "game";

    private $conexion;

    public function conectar()
    {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->contraseña, $this->base_datos);

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function desconectar()
    {
        $this->conexion->close();
    }

    public function registrarUsuario($usuario, $contraseña, $email)
    {
        $sql_check = "SELECT COUNT(*) AS total FROM Usuarios WHERE email='$email'";
        $result_check = $this->conexion->query($sql_check);
        $row = $result_check->fetch_assoc();
        if ($row['total'] > 0) {
            return false;
        }

        $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

        $sql = "INSERT INTO Usuarios (usuario, contraseña, email) VALUES ('$usuario', '$hashed_password', '$email')";

        if ($this->conexion->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarCredenciales($usuario, $contraseña)
    {
        $sql = "SELECT contraseña FROM Usuarios WHERE usuario='$usuario'";
        $result = $this->conexion->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['contraseña'];
            if (password_verify($contraseña, $hashed_password)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get($usuario)
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";

        $result = $this->conexion->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function updatePuntos($id)
    {
        $sql = "UPDATE usuarios SET puntos = puntos + 10 WHERE id = ?";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return true;
    }

    public function getPuntos($usuario)
    {
        $sql = "SELECT puntos FROM usuarios WHERE usuario = '$usuario'";
        $result = $this->conexion->query($sql);
        $row = $result->fetch_assoc();
        return $row['puntos'];
    }
}
