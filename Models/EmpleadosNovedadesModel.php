<?php

require_once 'config\connection.php';

class EmpleadosNovedadesModel extends DBAbstractModel
{
    private $table = 'empleados_novedades';

    public function getEmpleadosNovedades()
    {
        $this->connect();

        $query = "SELECT * FROM $this->table";
        $result = $this->conn->query($query);

        $this->closeConnection();

        return $result;
    }

    public function getEmpleadosNovedad($id)
    {
        $this->connect();

        $id = $this->conn->escape_string($id);

        $query = "SELECT * FROM $this->table WHERE id = '$id'";
        $result = $this->conn->query($query);

        $this->closeConnection();

        return $result;
    }

    public function insertEmpleadosNovedad($id_empleado, $id_novedad, $valor, $fecha)
    {
        $this->connect();

        $id_empleado = $this->conn->escape_string($id_empleado);
        $id_novedad = $this->conn->escape_string($id_novedad);
        $valor = $this->conn->escape_string($valor);
        $fecha = $this->conn->escape_string($fecha);

        $query = "INSERT INTO $this->table (id_empleado, id_novedad, valor, fecha) VALUES ('$id_empleado', '$id_novedad', '$valor', '$fecha')";
        $result = $this->conn->query($query);

        $this->closeConnection();

        return $result;
    }

}