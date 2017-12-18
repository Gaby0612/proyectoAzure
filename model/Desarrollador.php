<?php

/**
 * Description of Desarrollador
 *
 * @author Gaby
 */
class Desarrollador {
    private $cedulaDes;
    private $nombresDes;
    private $fechaNacimiento;
    private $telefono;
    private $direccion;
    private $email;
    private $codCategoria;
    
    function __construct($cedulaDes, $nombresDes, $fechaNacimiento, $telefono, $direccion, $email, $codCategoria) {
        $this->cedulaDes = $cedulaDes;
        $this->nombresDes = $nombresDes;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->email = $email;
        $this->codCategoria = $codCategoria;
    }
    
    function getCedulaDes() {
        return $this->cedulaDes;
    }

    function getNombresDes() {
        return $this->nombresDes;
    }

    function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getEmail() {
        return $this->email;
    }

    function getCodCategoria() {
        return $this->codCategoria;
    }

    function setCedulaDes($cedulaDes) {
        $this->cedulaDes = $cedulaDes;
    }

    function setNombresDes($nombresDes) {
        $this->nombresDes = $nombresDes;
    }

    function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setCodCategoria($codCategoria) {
        $this->codCategoria = $codCategoria;
    }




}
