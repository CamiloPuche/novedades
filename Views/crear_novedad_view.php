<!DOCTYPE html>
<html>

<head>
    <title>Agregar Novedad</title>
</head>

<body>
    <h1>Agregar Novedad</h1>
    <form method="POST" action="index.php?action=create">
        <label for="id_empleado">ID Empleado:</label>
        <select id="select-empleado" name="id_empleado">
            <?php
            require_once 'config/BDconnect.php';
            $db = new DBConnect();
            $result = $db->select("SELECT DISTINCT tiene_novedad.id_empleado, empleado.nombre FROM tiene_novedad INNER JOIN empleado ON tiene_novedad.id_empleado = empleado.id");

            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['id_empleado'] . '">' . $row['nombre'] . ' - ' . $row['id_empleado'] . '</option>';
            }
            ?>
        </select>
        <br>
        <label for="id_novedad">ID Novedad:</label>
        <select id="select-novedad-container" name="id_novedad"></select>
        <br>
        <label for="valor">Valor:</label>
        <input type="text" id="valor" name="valor">
        <br>
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha">
        <br>
        <input type="submit" value="Agregar">
    </form>
</body>

<script>
    var selectEmpleado = document.getElementById('select-empleado');

    // Escuchar el evento change en el primer select
    selectEmpleado.addEventListener('change', function () {
        var selectedIdEmpleado = this.value; // Obtener el valor seleccionado

        // Realizar la solicitud AJAX para obtener las opciones del segundo select
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Actualizar el contenido del contenedor del segundo select con las nuevas opciones
                    var selectNovedadContainer = document.getElementById('select-novedad-container');
                    selectNovedadContainer.innerHTML = xhr.responseText;
                } else {
                    console.error('Error al obtener las opciones del segundo select');
                }
            }
        }

        xhr.open('GET', 'Controllers/GetNovedades.php?id_empleado=' + selectedIdEmpleado, true);
        xhr.send();
    });
</script>

</html>