<?php

$selectedIdEmpleado = $_GET['id_empleado'];

require_once 'C:\xampp\htdocs\novedades\config\BDconnect.php';
$db = new DBConnect();
$result = $db->select("SELECT DISTINCT tiene_novedad.id_novedad, novedades.descripcion, novedades.tipo FROM tiene_novedad INNER JOIN novedades ON tiene_novedad.id_novedad = novedades.id_novedad WHERE tiene_novedad.id_empleado = '$selectedIdEmpleado'");

$options = '';
while ($row = $result->fetch_assoc()) {
    $options .= '<option value="' . $row['id_novedad'] . '">' . $row['descripcion'] . ' ' . $row['tipo'] . ' (' . $row['id_novedad'] . ')</option>';
}

echo $options;
?>
