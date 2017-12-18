<?php

include_once 'Database.php';
include_once 'Desarrollador.php';
include_once 'Proyectos.php';
include_once 'AsignacionCab.php';
include_once 'AsignacionDet.php';
include_once 'CrudModel.php';

/**
 * Clase que implementa la logica de asignacion.
 *
 * @author Gaby 
 */
class AsignacionModel {

    /**
     * 
     * @return array
     */
    public function getAsignaciones() {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from asignacioncab order by codCabecera desc";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos:
        $listado = array();
        foreach ($resultado as $res) {
            $asignacion = new AsignacionCab();
            $asignacion->setCodAsignacionCab($res['codCabecera']);
            $asignacion->setCod_proyecto($res['codProyecto']);
            $asignacion->setCedula_Jefe($res['cedulaJefe']);
            $asignacion->setFechaInicio($res['fecha_Inicio']);
            $asignacion->setFechaFin($res['fecha_Fin']);
            array_push($listado, $asignacion);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }

    /**
     *  Funcion que adiciona un nuevo desarrollador en los detalles de una factura. La lista
     * de detalles se encuentra en memoria.
     * @param array $listaAsignacionDet
     * @param type $cedDesarrollador
     * @return array
     */
    public function adicionarDesarrollador($listaAsignacionDet, $cedDesarrollador) {

        //elegimos el desarrollador:
        $crudModel = new CrudModel();
        $desa = $crudModel->getDesarrollador($cedDesarrollador);
        //creamos un nuevo detalle FacturaDet:
        $asignacionDet = new AsignacionDet();
        $asignacionDet->setCedula_Des($desa->getCedulaDes());
        $asignacionDet->setNombres_Des($desa->getNombresDes());
        $asignacionDet->setEmailDet($desa->getEmail());
        $asignacionDet->setCodCategoriaDet($desa->getCodCategoria());
        //adicionamos el nuevo desarrollador al array en memoria:
        if (!isset($listaAsignacionDet)) {
            $listaAsignacionDet = array();
        }
        array_push($listaAsignacionDet, $asignacionDet);
        return $listaAsignacionDet;
    }

    /**
     * elimina un desarrollador añadido 
     * @param type $listaAsignacionDet
     * @param type $cedDesarrollador
     * @return type
     */
    public function eliminarDesarrollador($listaAsignacionDet, $cedDesarrollador) {
        //buscamos el producto:
        $cont = 0;
        foreach ($listaAsignacionDet as $det) {
            if ($det->getCedula_Des() == $cedDesarrollador) {
                unset($listaAsignacionDet[$cont]);
                //reindexamos el array para eliminar el lugar vacio:
                $listaAsignacionDet = array_values($listaAsignacionDet);
                break;
            }
            $cont++;
        }
        return $listaAsignacionDet;
    }

    public function ultimoNumeroFactura() {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select max(codCabecera) numero from asignacioncab";
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        //obtenemos el registro especifico:
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $numero = $res['numero'];
        Database::disconnect();
        //retornamos el numero encontrado:
        if (!isset($numero))
            return 0;
        return $numero;
    }

    /**
     * guarda una nueva asignacion 
     * @param type $listaAsignacionDet
     * @param type $codProyec
     * @param type $cedulaProyec
     * @param type $fechaInicio
     * @param type $fechaFin
     * @param type $cedulaDes
     * @return \AsignacionCab
     * @throws Exception
     */
    public function guardarAsignacion($listaAsignacionDet, $codProyec, $cedulaProyec, $fechaInicio, $fechaFin, $cedulaDes) {
        if (!isset($listaAsignacionDet)) {
            throw new Exception("Debe por lo menos añadir un desarrollador.");
        }
        if (count($listaAsignacionDet) == 0) {
            throw new Exception("Debe por lo menos añadir un desarrollador.");
        }
        if (!isset($codProyec)) {
            throw new Exception("Debe seleccionar el proyecto.");
        }
        //obtenemos los datos completos del proyecto:
        $crudModel = new CrudModel();
        $pro = $crudModel->getProyecto($codProyec);
        $desa = $crudModel->getDesarrollador($cedulaDes);
        //creamos la nueva asignacion:
        $asignacionCab = new AsignacionCab();
        $asignacionCab->setCod_proyecto($codProyec);
        $asignacionCab->setProyectoCab($pro->getProyecto());
        $asignacionCab->setCedula_Jefe($cedulaProyec);
        $asignacionCab->setFechaInicio($fechaInicio);
        $asignacionCab->setFechaFin($fechaFin);
        //obtenemos el siguiente numero de asignacion:
        $asignacionCab->setCodAsignacionCab($this->ultimoNumeroFactura() + 1);
        //guardar la cabecera:
        $pdo = Database::connect();
        $sql = "insert into asignacioncab (codCabecera,codProyecto,cedulaJefe,fecha_Inicio,fecha_Fin) values(?,?,?,?,?)";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($asignacionCab->getCodAsignacionCab(),
                $asignacionCab->getCod_proyecto(),
                $asignacionCab->getCedula_Jefe(),
                $asignacionCab->getFechaInicio(),
                $asignacionCab->getFechaFin()));
            //guardamos los detalles:
            foreach ($listaAsignacionDet as $det) {
                $sql = "insert into asignaciondet(codCabecera,cedulaDesarrollador,nombreDesarrollador,email,codCategoria) values(?,?,?,?,?)";
                $consulta = $pdo->prepare($sql);
                //en cada detalle asignamos el numero de factura padre:
                $consulta->execute(array($asignacionCab->getCodAsignacionCab(),
                    $det->getCedula_Des(),
                    $det->getNombres_Des(),
                    $det->getEmailDet(),
                    $det->getCodCategoriaDet()
                ));
            }
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
        return $asignacionCab;
    }

}
