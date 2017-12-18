<?php

include_once 'Database.php';
include_once 'Desarrollador.php';
include_once 'Proyectos.php';
include_once 'Categoria.php';

/**
 * Clase para el manejo CRUD de desarroladores y proyectos.
 *
 * @author GABY CARRION
 */
class CrudModel {
    //////////////////////////
    //DESARROLLADORES:
    //////////////////////////

    /**
     * Retorna la lista de desarrolladores de la bdd.
     * @return array
     */
    public function getDesarrolladores() {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from desarrollador order by nombresDes";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos:
        $listado = array();
        foreach ($resultado as $res) {
            $desarrollador = new Desarrollador($res['cedulaDes'], $res['nombresDes'], $res['fechaNacimiento'], $res['telefono'], $res['direccion'], $res['email'], $res['codCategoria']);
            array_push($listado, $desarrollador);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }

    /**
     *  Busca la informacion de un desarrollador especifico.
     * @param type $cedula
     * @return \Desarrollador
     */
    public function getDesarrollador($cedula) {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from desarrollador where cedulaDes=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($cedula));
        //obtenemos el registro especifico:
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $desarrollador = new Desarrollador($res['cedulaDes'], $res['nombresDes'], $res['fechaNacimiento'], $res['telefono'], $res['direccion'], $res['email'], $res['codCategoria']);
        Database::disconnect();
        //retornamos el objeto encontrado:
        return $desarrollador;
    }

    /**
     * Inserta un nuevo desarrollador en la bdd.
     * @param type $cedula
     * @param type $nombres
     * @param type $fechaNacimiento
     * @param type $telefono
     * @param type $direccion
     * @param type $email
     * @param type $codCategoria
     * @throws Exception
     */
    public function insertarDesarrollador($cedula, $nombres, $fechaNacimiento, $telefono, $direccion, $email, $codCategoria) {
        $pdo = Database::connect();
        $sql = "insert into desarrollador(cedulaDes,nombresDes,fechaNacimiento,telefono,direccion,email,codCategoria) values(?,?,?,?,?,?,?)";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($cedula, $nombres, $fechaNacimiento, $telefono, $direccion, $email, $codCategoria));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }

    /**
     * Elimina un cliente desarrollador de la bdd.
     * @param type $cedula
     */
    public function eliminarDesarrollador($cedula) {
        //Preparamos la conexion a la bdd:
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "delete from desarrollador where cedulaDes=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($cedula));
        Database::disconnect();
    }

    /**
     * Actualiza un desarrollador existente.
     * @param type $cedula
     * @param type $nombres
     * @param type $fechaNacimiento
     * @param type $telefono
     * @param type $direccion
     * @param type $email
     * @param type $codCategoria
     */
    public function actualizarDesarrollador($cedula, $nombres, $fechaNacimiento, $telefono, $direccion, $email, $codCategoria) {
        //Preparamos la conexión a la bdd:
        $pdo = Database::connect();
        $sql = "update desarrollador set nombresDes=?,fechaNacimiento=?, telefono=?,direccion=?, email=?,codCategoria=? where cedulaDes=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($nombres, $fechaNacimiento, $telefono, $direccion, $email, $codCategoria, $cedula));
        Database::disconnect();
    }

    //////////////////////////
    //PROYECTOS:
    //////////////////////////

    /**
     * Retorna la lista de proyectos de la bdd.
     * @return array
     */
    public function getProyectos() {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from proyectos order by fechaRecepcion";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos:
        $listado = array();
        foreach ($resultado as $res) {
            $proyecto = new Proyectos($res['codProyecto'], $res['proyecto'], $res['fechaRecepcion'], $res['fechaEntrega']);
            array_push($listado, $proyecto);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }

    /**
     * Busca la informacion de un proyecto especifico.
     * @param type $codProyecto
     * @return \Proyectos
     */
    public function getProyecto($codProyecto) {
        //obtenemos la informacion de la bdd:
        $pdo = Database::connect();
        $sql = "select * from proyectos where codProyecto=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($codProyecto));
        //obtenemos el objeto especifico:
        $res = $consulta->fetch(PDO::FETCH_ASSOC);
        $proyecto = new Proyectos($res['codProyecto'], $res['proyecto'], $res['fechaRecepcion'], $res['fechaEntrega']);
        Database::disconnect();
        //retornamos el objeto encontrado:
        return $proyecto;
    }

    /**
     *  Inserta un nuevo proyecto en la bdd.
     * @param type $codProyecto
     * @param type $proyecto
     * @param type $fechaRecepcion
     * @param type $fechaEntrega
     * @throws Exception
     */
    public function insertarProyecto($codProyecto, $proyecto, $fechaRecepcion, $fechaEntrega) {
        $pdo = Database::connect();
        $sql = "insert into proyectos(codProyecto,proyecto,fechaRecepcion,fechaEntrega) values(?,?,?,?)";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos y pasamos los parametros:
        try {
            $consulta->execute(array($codProyecto, $proyecto, $fechaRecepcion, $fechaEntrega));
        } catch (PDOException $e) {
            Database::disconnect();
            throw new Exception($e->getMessage());
        }
        Database::disconnect();
    }

    /**
     * Elimina un Proyecto especifico de la bdd.
     * @param type $codProyecto
     */
    public function eliminarProyecto($codProyecto) {
        //Preparamos la conexion a la bdd:
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "delete from proyectos where codProyecto=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($codProyecto));
        Database::disconnect();
    }

    /**
     *  Actualiza un proyecto existente.
     * @param type $codProyecto
     * @param type $proyecto
     * @param type $fechaRecepcion
     * @param type $fechaEntrega
     */
    public function actualizarProyecto($codProyecto, $proyecto, $fechaRecepcion, $fechaEntrega) {
        //Preparamos la conexión a la bdd:
        $pdo = Database::connect();
        $sql = "update proyectos set proyecto=?, fechaRecepcion=?, fechaEntrega=? where codProyecto=?";
        $consulta = $pdo->prepare($sql);
        //Ejecutamos la sentencia incluyendo a los parametros:
        $consulta->execute(array($proyecto, $fechaRecepcion, $fechaEntrega, $codProyecto));
        Database::disconnect();
    }

    /**
     * recupera las categorias de la bd
     * @return array
     */
    public function getCategorias() {
        $pdo = Database::connect();
        $sql = "select*from categoria";
        $resultado = $pdo->query($sql);
        //transformamos los registros en objetos:
        $listado = array();
        foreach ($resultado as $res) {
            $categoria = new Categoria();
            $categoria->setCodCategoria($res['codCategoria']);
            $categoria->setCategoria($res['categoria']);
            array_push($listado, $categoria);
        }
        Database::disconnect();
        //retornamos el listado resultante:
        return $listado;
    }
    
    /**
     * muestra solo los desarrolladores con un codcategoria especifico
     * @param type $codCategoria
     * @return array
     */

    public function getCategoriaExperto($codCategoria) {
        $pdo = Database::connect();
        $sql = "select * from desarrollador where codCategoria=?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute(array($codCategoria));
        $resp = $consulta->fetchAll();
        $listadoExperto = array();
        foreach ($resp as $res) {
            $desarrollador1 = new Desarrollador($res['cedulaDes'], $res['nombresDes'], $res['fechaNacimiento'], $res['telefono'], $res['direccion'], $res['email'], $res['codCategoria']);
            array_push($listadoExperto, $desarrollador1);
        }
        Database::disconnect();
        return $listadoExperto;
    }

}
