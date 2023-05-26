<!DOCTYPE html>
<html>
<head>
    <title>Empleados Novedades</title>
</head>
<body>
    <h1>Listado de Novedades de Empleados</h1>
    <table>
        <tr>
            <th>ID Empleado</th>
            <th>ID Novedad</th>
            <th>Valor</th>
            <th>Fecha</th>
        </tr>
        <?php while ($row = $empleadosNovedades->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id_empleado']; ?></td>
                <td><?php echo $row['id_novedad']; ?></td>
                <td><?php echo $row['valor']; ?></td>
                <td><?php echo $row['fecha']; ?></td>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="index.php?action=create">Agregar Novedad</a>
</body>
</html>
