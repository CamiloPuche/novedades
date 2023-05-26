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
            require_once 'C:\xampp\htdocs\novedades\config\BDconnect.php';
            $db = new DBConnect();

            // Obtener los valores de la tabla tiene_novedad
            $result = $db->select("SELECT DISTINCT tiene_novedad.id_empleado, empleado.nombre FROM tiene_novedad INNER JOIN empleado ON tiene_novedad.id_empleado = empleado.id");

            // Obtener los empleados ya registrados en empleados_novedades
            $resultRegistrados = $db->select("SELECT DISTINCT id_empleado FROM empleados_novedades");

            // Crear un array con los id_empleado ya registrados
            $empleadosRegistrados = [];
            while ($row = $resultRegistrados->fetch_assoc()) {
                $empleadosRegistrados[] = $row['id_empleado'];
            }

            // Generar las opciones del select con los valores obtenidos
            while ($row = $result->fetch_assoc()) {
                // Verificar si el id_empleado ya está registrado
                if (!in_array($row['id_empleado'], $empleadosRegistrados)) {
                    echo '<option value="' . $row['id_empleado'] . '">' . $row['nombre'] . ' - ' . $row['id_empleado'] . '</option>';
                }
            }
            ?>
        </select>

        <br>
        <label for="id_novedad">ID Novedad:</label>
        <input type="hidden" id="id_novedad" name="id_novedad" value="">
        <div id="select-novedad-container">
        </div>
        <br>
        <label for="valor">Valor:</label>
        <input type="text" id="valor" name="valor">
        <br>
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha">
        <br>
        <input type="submit" value="Agregar">
        <br>
    </form>
    <a href="index.php?" style="text-decoration: none;">
        <button style="padding: 10px 20px;">Volver</button>
    </a>

    <script>
        // Obtener referencia al primer select
        var selectEmpleado = document.getElementById('select-empleado');

        // Obtener referencia al contenedor de la novedad
        var novedadContainer = document.getElementById('select-novedad-container');

        // Obtener referencia al campo de ID Novedad
        var idNovedadInput = document.getElementById('id_novedad');

        // Función para realizar la solicitud AJAX y obtener los datos de la novedad
        function obtenerDatosNovedad(selectedIdEmpleado) {
            // Realizar la solicitud AJAX para obtener los datos de la novedad
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Actualizar el contenido del contenedor con los datos de la novedad
                        novedadContainer.innerHTML = xhr.responseText;
                        var response = JSON.parse(xhr.responseText);

                        // Asignar el id_novedad al campo oculto del formulario
                        idNovedadInput.value = response.id_novedad;
                    } else {
                        console.error('Error al obtener los datos de la novedad');
                    }
                }
            };

            // Establecer la URL del archivo PHP que devuelve los datos de la novedad
            xhr.open('GET', 'Controllers/GetNovedades.php?id_empleado=' + selectedIdEmpleado, true);
            xhr.send();
        }
        // Función para realizar la solicitud AJAX y obtener los datos de la novedad
        function obtenerIdNovedad(selectedIdEmpleado) {
            // Realizar la solicitud AJAX para obtener los datos de la novedad
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Actualizar el contenido del contenedor con los datos de la novedad
                        var response = JSON.parse(xhr.responseText);

                        // Asignar el id_novedad al campo oculto del formulario
                        idNovedadInput.value = response.id_novedad;
                    } else {
                        console.error('Error al obtener los datos de la novedad');
                    }
                }
            };

            // Establecer la URL del archivo PHP que devuelve los datos de la novedad
            xhr.open('GET', 'Controllers/GetNovedadId.php?id_empleado=' + selectedIdEmpleado, true);
            xhr.send();
        }

        // Ejecutar la función al cargar la página para obtener los datos de la novedad inicialmente
        obtenerDatosNovedad(selectEmpleado.value);

        // Escuchar el evento change en el primer select
        selectEmpleado.addEventListener('change', function () {
            var selectedIdEmpleado = this.value; // Obtener el valor seleccionado

            // Llamar a la función para obtener los datos de la novedad
            obtenerDatosNovedad(selectedIdEmpleado);
        });
    </script>
</body>

</html>