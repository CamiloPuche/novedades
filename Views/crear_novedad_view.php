<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <style>
        .form-container {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
    <title>Agregar Novedad</title>
</head>

<body>
    <h1 class="text-center">Agregar Novedad</h1>
    <form class="container" method="POST" action="index.php?action=create">
        <div class="form-container">
            <label for="id_empleado">ID Empleado:</label>
            <select class="form-select" id="select-empleado" name="id_empleado">
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
            <input type="hidden" id="id_novedad" name="id_novedad" value="">
            <div class="form-group" id="select-novedad-container">
            </div>
            <br>
            <div class="form-group form-floating">
                <input class="form-control" id="floatingInput" placeholder="Valor" type="text" id="valor" name="valor">
                <label for="valor" for="floatingInput">Valor</label>
            </div>
            <br>
            <div class="form-group form-floating">
                <input class="form-control" id="floatingInput" placeholder="Fecha" type="date" id="fecha" name="fecha">
                <label for="fecha" for="floatingInput">Fecha</label>
            </div>
            <br>
            <input type="submit" class="btn btn-primary" value="Agregar">
            <br>
            <?php if (isset($validacionMensaje)): ?>
            <div  class="alert <?php echo ($validacionMensaje == 'Novedad agregada correctamente') ? 'alert alert-primary' : 'alert alert-danger'; ?> mt-3" role="alert">
                <?php echo $validacionMensaje; ?>
            </div>
            <?php endif; ?>
        </div>
    </form>
    <a href="index.php?" class="d-block text-center mt-3" style="text-decoration: none;">
        <button class="btn btn-secondary">Volver</button>
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
                        // Obtener el contenedor de la novedad
                        var novedadContainer = document.getElementById('select-novedad-container');

                        // Limpiar el contenido actual del contenedor
                        novedadContainer.innerHTML = '';

                        // Obtener la respuesta JSON
                        var response = JSON.parse(xhr.responseText);

                        // Crear los elementos HTML para mostrar los datos de la novedad
                        var idNovedadLabel = document.createElement('label');
                        idNovedadLabel.textContent = 'ID Novedad:';
                        var idNovedadValue = document.createElement('span');
                        idNovedadValue.textContent = response.id_novedad;

                        var descripcionLabel = document.createElement('label');
                        descripcionLabel.textContent = 'Descripción:';
                        var descripcionValue = document.createElement('span');
                        descripcionValue.textContent = response.descripcion;

                        var tipoLabel = document.createElement('label');
                        tipoLabel.textContent = 'Tipo:';
                        var tipoValue = document.createElement('span');
                        tipoValue.textContent = response.tipo;

                        // Agregar las clases de Bootstrap a los elementos HTML
                        idNovedadLabel.classList.add('form-label', 'text-muted', 'h5');
                        idNovedadValue.classList.add('h5');
                        descripcionLabel.classList.add('form-label', 'text-muted', 'h5');
                        descripcionValue.classList.add('h5');
                        tipoLabel.classList.add('form-label', 'text-muted', 'h5');
                        tipoValue.classList.add('h5');

                        // Agregar los elementos HTML al contenedor
                        novedadContainer.appendChild(idNovedadLabel);
                        novedadContainer.appendChild(idNovedadValue);
                        novedadContainer.appendChild(document.createElement('br'));
                        novedadContainer.appendChild(descripcionLabel);
                        novedadContainer.appendChild(descripcionValue);
                        novedadContainer.appendChild(document.createElement('br'));
                        novedadContainer.appendChild(tipoLabel);
                        novedadContainer.appendChild(tipoValue);

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