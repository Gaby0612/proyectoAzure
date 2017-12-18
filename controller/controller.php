<?php

///////////////////////////////////////////////////////////////////////
//Componente controller que verifica la opcion seleccionada
//por el usuario, ejecuta el modelo y enruta la navegacion de paginas.
///////////////////////////////////////////////////////////////////////
require_once '../model/CrudModel.php';
require_once '../model/AsignacionModel.php';


session_start();
//instanciamos los objetos de negocio:
$crudModel = new CrudModel();
$asignacionModel = new AsignacionModel();

//recibimos la opcion desde la vista:
$opcion = $_REQUEST['opcion'];
$mensajeError = "";
//limpiamos cualquier mensaje previo:
unset($_SESSION['mensajeError']);

switch ($opcion) {
    case "listar_desarrollador":
        //obtenemos la lista:
        $listaDesarrollador = $crudModel->getDesarrolladores();
        //y los guardamos en sesion:
        $_SESSION['listaDesarrollador'] = serialize($listaDesarrollador);
        // print_r($listaDesarrollador);
        //redireccionamos a una nueva pagina para visualizar:
        header('Location: ../view/desarrolladores.php');
        break;
    case "listar_proyectos":
        //obtenemos la lista:
        $listaProyectos = $crudModel->getProyectos();
        //y los guardamos en sesion:
        $_SESSION['listaProyectos'] = serialize($listaProyectos);
        //redireccionamos a una nueva pagina para visualizar:
        header('Location: ../view/proyecto.php');
        break;
    case "crear_desarrollador":
        //obtenemos los parametros del formulario:
        $cedulaDes = $_REQUEST['cedulaDes'];
        $nombresDes = $_REQUEST['nombresDes'];
        $fechaNacimiento = $_REQUEST['fechaNacimiento'];
        $telefono = $_REQUEST['telefono'];
        $direccion = $_REQUEST['direccion'];
        $email = $_REQUEST['email'];
        $codCategoria = $_REQUEST['codCategoria'];

//        echo $cedulaDes;
//        echo $nombresDes ;
//        echo $fechaNacimiento ;
//        echo $telefono ;
//        echo $direccion;
//        echo  $email;
//        echo $codCategoria ;
        //creamos el nuevo registro:
        $crudModel->insertarDesarrollador($cedulaDes, $nombresDes, $fechaNacimiento, $telefono, $direccion, $email, $codCategoria);
        //actualizamos el listado:
        $listaDesarrollador = $crudModel->getDesarrolladores();
        //y los guardamos en sesion:
        $_SESSION['listaDesarrollador'] = serialize($listaDesarrollador);
        //redireccionamos a una nueva pagina para visualizar:
        header('Location: ../view/desarrolladores.php');
        break;
    case "crear_proyecto":
        //obtenemos los parametros del formulario:
        $codProyecto = $_REQUEST['codProyecto'];
        $proyecto = $_REQUEST['proyecto'];
        $fechaRecepcion = $_REQUEST['fechaRecepcion'];
        $fechaEntrega = $_REQUEST['fechaEntrega'];
        //creamos el nuevo registro:
        $crudModel->insertarProyecto($codProyecto, $proyecto, $fechaRecepcion, $fechaEntrega);
        //actualizamos el listado:
        $listaProyectos = $crudModel->getProyectos();
        //y los guardamos en sesion:
        $_SESSION['listaProyectos'] = serialize($listaProyectos);
        //redireccionamos a una nueva pagina para visualizar:
        header('Location: ../view/proyecto.php');
        break;

    case "editar_desarrollador":
        //obtenemos los parametros del formulario:
        $cedulaDes = $_REQUEST['cedulaDes'];
        //Buscamos los datos
        $Desarrollador = $crudModel->getDesarrollador($cedulaDes);
        //guardamos en sesion para edicion posterior:
        $_SESSION['Desarrollador'] = serialize($Desarrollador);
        //redirigimos la navegación al formulario de edicion:
        header('Location: ../view/editarDesarrollador.php');
        break;

    case "actualizar_desarrollador":
        //obtenemos los parametros del formulario:
        $cedulaDes = $_REQUEST['cedulaDes'];
        $nombresDes = $_REQUEST['nombresDes'];
        $fechaNacimiento = $_REQUEST['fechaNacimiento'];
        $telefono = $_REQUEST['telefono'];
        $direccion = $_REQUEST['direccion'];
        $email = $_REQUEST['email'];
        $codCategoria = $_REQUEST['codCategoria'];


        //actualizamos el desarrollador:
        $crudModel->actualizarDesarrollador($cedulaDes, $nombresDes, $fechaNacimiento, $telefono, $direccion, $email, $codCategoria);
        //actualizamos lista de desarrolladores:
        $listaDesarrollador = $crudModel->getDesarrolladores();
        $_SESSION['listaDesarrollador'] = serialize($listaDesarrollador);
        header('Location: ../view/desarrolladores.php');
        break;

    case "eliminar_desarrollador":
        //obtenemos el codigo del desarrollador a eliminar:
        $cedulaDes = $_REQUEST['cedulaDes'];
        //eliminamos el producto:
        $crudModel->eliminarDesarrollador($cedulaDes);
        //actualizamos la lista de desarrolladores para grabar en sesion:
        $listaDesarrollador = $crudModel->getDesarrolladores();
        $_SESSION['listaDesarrollador'] = serialize($listaDesarrollador);
        header('Location: ../view/desarrolladores.php');
        break;

    case "editar_proyecto":
        //obtenemos los parametros del formulario:
        $codProyecto = $_REQUEST['codProyecto'];
        //Buscamos los datos
        $Proyectos = $crudModel->getProyecto($codProyecto);
        //guardamos en sesion para edicion posterior:
        $_SESSION['Proyectos'] = serialize($Proyectos);
        //redirigimos la navegación al formulario de edicion:
        header('Location: ../view/editarProyecto.php');
        break;

    case "actualizar_proyecto":
        //obtenemos los parametros del formulario:

        $codProyecto = $_REQUEST['codProyecto'];
        $proyecto = $_REQUEST['proyecto'];
        $fechaRecepcion = $_REQUEST['fechaRecepcion'];
        $fechaEntrega = $_REQUEST['fechaEntrega'];

//        echo $codProyecto;
//        echo $proyecto;
//        echo $fechaRecepcion;
//        echo $fechaEntrega;
        //actualizamos el proyecto:
        $crudModel->actualizarProyecto($codProyecto, $proyecto, $fechaRecepcion, $fechaEntrega);
        //actualizamos lista de proyectos:
        $listaProyectos = $crudModel->getProyectos();
        $_SESSION['listaProyectos'] = serialize($listaProyectos);
        header('Location: ../view/proyecto.php');
        break;


    case "eliminar_proyecto":
        //obtenemos el codigo del producto a eliminar:
        $codProyecto = $_REQUEST['codProyecto'];
        //eliminamos el producto:
        $crudModel->eliminarProyecto($codProyecto);
        //actualizamos la lista de productos para grabar en sesion:
        $listaProyectos = $crudModel->getProyectos();
        $_SESSION['listaProyectos'] = serialize($listaProyectos);
        header('Location: ../view/proyecto.php');
        break;


    case "listar_asignaciones":
        //obtenemos la lista de asignaciones y subimos a sesion:
        $_SESSION['listaAsignaciones'] = serialize($asignacionModel->getAsignaciones());
        header('Location: ../view/asignacionesRealizadas.php');
        break;


    case "nueva_asignacion":
        unset($_SESSION['listaAsignacionDet']);
        header('Location: ../view/asignacion.php');
        break;


    case "adicionar_desarrollador":
        //obtenemos los parametros del formulario:
        $cedulaDesarrolladorAdicionar = $_REQUEST['cedulaDesarrolladorAdicionar'];
        if (!isset($_SESSION['listaAsignacionDet'])) {
            $listaAsignacionDet = array();
        } else {
            $listaAsignacionDet = unserialize($_SESSION['listaAsignacionDet']);
        }
        try {
            $listaAsignacionDet = $asignacionModel->adicionarDesarrollador($listaAsignacionDet, $cedulaDesarrolladorAdicionar);
            $_SESSION['listaAsignacionDet'] = serialize($listaAsignacionDet);
        } catch (Exception $e) {
            $mensajeError = $e->getMessage();
            $_SESSION['mensajeError'] = $mensajeError;
        }
       // print_r($listaAsignacionDet);
        header('Location: ../view/asignacion.php');
        break;

    case "eliminar_detalle":
        //obtenemos los parametros del formulario:
        $cedulaDesarrollador = $_REQUEST['cedulaDesarrollador'];
        $listaAsignacionDet = unserialize($_SESSION['listaAsignacionDet']);
        $listaAsignacionDet = $asignacionModel->eliminarDesarrollador($listaAsignacionDet, $cedulaDesarrollador);
        $_SESSION['listaAsignacionDet'] = serialize($listaAsignacionDet);
        //print_r($listaAsignacionDet);
        header('Location: ../view/asignacion.php');
        break;


    case "guardar_asignacion":
        //obtenemos los parametros del formulario:
        $proyectoAsigna = $_REQUEST['proyectoAsigna'];
        $jefeProyecto = $_REQUEST['jefeProyecto'];
        $fechaInicio = $_REQUEST['fechaInicio'];
        $fechaFin = $_REQUEST['fechaFin'];
        $cedulaDesarrolladorAdicionar = $_REQUEST['cedulaDesarrolladorAdicionar'];
        if (isset($_SESSION['listaAsignacionDet'])) {
            $listaAsignacionDet = unserialize($_SESSION['listaAsignacionDet']);
            try {
                $asignacionCab = $asignacionModel->guardarAsignacion($listaAsignacionDet, $proyectoAsigna, $jefeProyecto, $fechaInicio, $fechaFin, $cedulaDesarrolladorAdicionar);
                $_SESSION['asignacionCab'] = $asignacionCab;
               header('Location: ../view/asignacion_reporte.php');
                break;
            } catch (Exception $e) {
                $mensajeError = $e->getMessage();
                $_SESSION['mensajeError'] = $mensajeError;
            }
        }
        //actualizamos lista de asignaciones:
        //$listado = $gastosModel->getFacturas();
        //$_SESSION['listado'] = serialize($listado);
        header('Location: ../view/asignacion.php');
        break;


    default:
        //si no existe la opcion recibida por el controlador, siempre
        //redirigimos la navegacion a la pagina index:
        header('Location: ../view/index.php');
}

