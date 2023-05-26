<?php
// Archivo GetNovedades.php

// Obtener el ID de empleado seleccionado desde el parámetro de la URL
if (isset($_GET['id_empleado'])) {
    $id_empleado = $_GET['id_empleado'];

    // Realizar la consulta para obtener los datos de la novedad
    function obtenerDatosNovedad($id_empleado)
    {
        // Realiza aquí la consulta a la base de datos para obtener los datos de la novedad correspondientes al ID de empleado
        // y devuelve un array asociativo con los datos encontrados.
        // Puedes adaptar esta función según la estructura de tu base de datos y las consultas que necesites realizar.
        // Por ejemplo:
        require_once 'C:\xampp\htdocs\novedades\config\BDconnect.php';
        $db = new DBConnect();

        $result = $db->select("SELECT tiene_novedad.id_novedad, novedades.descripcion, novedades.tipo FROM tiene_novedad INNER JOIN novedades ON tiene_novedad.id_novedad = novedades.id_novedad WHERE tiene_novedad.id_empleado = '$id_empleado'");

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    $novedadData = obtenerDatosNovedad($id_empleado);

    // Generar la respuesta en formato JSON
    if ($novedadData) {
        header('Content-Type: application/json');
        echo json_encode($novedadData);
    } else {
        echo json_encode(array('error' => 'No se encontraron datos de novedad para el empleado seleccionado.'));
    }
} else {
    echo json_encode(array('error' => 'ID de empleado no especificado.'));
}

// Función para obtener los datos de la novedad desde la base de datos
?>