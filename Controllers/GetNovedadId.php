<?php

// Verificar si se recibió el parámetro id_empleado
if (isset($_GET['id_empleado'])) {
    $idEmpleado = $_GET['id_empleado'];
    function obtenerIdNovedad($id_empleado)
    {
        require_once 'C:\xampp\htdocs\novedades\config\BDconnect.php';
        $db = new DBConnect();
        $query = "SELECT id_novedad FROM tiene_novedad WHERE id_empleado = $id_empleado";
        $result = $db->select($query);

        // Verificar si se encontró el id_novedad
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['id_novedad'];
        } else {
            return null;
        }
    }

    $id_novedad = obtenerIdNovedad($id_empleado);
}
?>