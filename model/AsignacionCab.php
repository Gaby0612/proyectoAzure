<?php

/**
 * Description of AsignacionCab
 *
 * @author Gaby
 */
class AsignacionCab {

    private $codAsignacionCab;
    private $cod_proyecto;
    private $proyectoCab;
    private $cedula_Jefe;
    private $fechaInicio;
    private $fechaFin;

    function getProyectoCab() {
        return $this->proyectoCab;
    }

    function setProyectoCab($proyectoCab) {
        $this->proyectoCab = $proyectoCab;
    }

    function getCodAsignacionCab() {
        return $this->codAsignacionCab;
    }

    function getCod_proyecto() {
        return $this->cod_proyecto;
    }

    function getCedula_Jefe() {
        return $this->cedula_Jefe;
    }

    function getFechaInicio() {
        return $this->fechaInicio;
    }

    function getFechaFin() {
        return $this->fechaFin;
    }

    function setCodAsignacionCab($codAsignacionCab) {
        $this->codAsignacionCab = $codAsignacionCab;
    }

    function setCod_proyecto($cod_proyecto) {
        $this->cod_proyecto = $cod_proyecto;
    }

    function setCedula_Jefe($cedula_Jefe) {
        $this->cedula_Jefe = $cedula_Jefe;
    }

    function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }

}
