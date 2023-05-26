<?php

require_once 'Models/EmpleadosNovedadesModel.php';

class EmpleadosNovedadesController
{
    private $model;

    public function __construct()
    {
        $this->model = new EmpleadosNovedadesModel();
    }

    public function index()
    {
        $empleadosNovedades = $this->model->getEmpleadosNovedades();

        require_once 'Views/empleados_novedades_view.php';
    }

    public function create()
    {
        // Verificar si se recibió una solicitud POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $id_empleado = $_POST['id_empleado'];
            $id_novedad = $_POST['id_novedad'];
            $valor = $_POST['valor'];
            $fecha = $_POST['fecha'];

            // Validar que los campos no estén vacíos
            if (empty($id_empleado) || empty($id_novedad) || empty($valor) || empty($fecha)) {
                echo "Por favor, complete todos los campos";
            } else {
                // Insertar la nueva novedad
                $result = $this->model->insertEmpleadosNovedad($id_empleado, $id_novedad, $valor, $fecha);

                if ($result) {
                    echo "Novedad agregada correctamente";
                } else {
                    echo "Error al agregar la novedad";
                }
            }
        }

        // Mostrar el formulario de creación
        require_once 'Views/crear_novedad_view.php';
    }

}