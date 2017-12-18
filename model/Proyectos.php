<?php

/**
 * Description of Proyectos
 *
 * @author Gaby
 */
class Proyectos {
    private $codProyecto;
    private $proyecto;
    private $fechaRecepcion;
    private $fechaEntrega;
    
    function __construct($codProyecto, $proyecto, $fechaRecepcion, $fechaEntrega) {
        $this->codProyecto = $codProyecto;
        $this->proyecto = $proyecto;
        $this->fechaRecepcion = $fechaRecepcion;
        $this->fechaEntrega = $fechaEntrega;
    }
    
    function getCodProyecto() {
        return $this->codProyecto;
    }

    function getProyecto() {
        return $this->proyecto;
    }

    function getFechaRecepcion() {
        return $this->fechaRecepcion;
    }

    function getFechaEntrega() {
        return $this->fechaEntrega;
    }

    function setCodProyecto($codProyecto) {
        $this->codProyecto = $codProyecto;
    }

    function setProyecto($proyecto) {
        $this->proyecto = $proyecto;
    }

    function setFechaRecepcion($fechaRecepcion) {
        $this->fechaRecepcion = $fechaRecepcion;
    }

    function setFechaEntrega($fechaEntrega) {
        $this->fechaEntrega = $fechaEntrega;
    }



}
