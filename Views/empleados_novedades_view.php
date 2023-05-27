<!DOCTYPE html>
<html>

<head>
    <title>Empleados Novedades</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1 class="mt-4 text-center">Novedades de Empleados</h1>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID Empleado</th>
                    <th>ID Novedad</th>
                    <th>Valor</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $empleadosNovedades->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo $row['id_empleado']; ?>
                        </td>
                        <td>
                            <?php echo $row['id_novedad']; ?>
                        </td>
                        <td>
                            <?php echo $row['valor']; ?>
                        </td>
                        <td>
                            <?php echo $row['fecha']; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <br>
        <a href="index.php?action=create" class="btn btn-primary">Agregar Novedad</a>
    </div>
</body>

</html>