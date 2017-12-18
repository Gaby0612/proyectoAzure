<?php

/**
 * Description of AsignacionDet
 *
 * @author Gaby
 */
class AsignacionDet {

    private $codAsignacionDet;
    private $cod_AsignacionCab;
    private $cedula_Des;
    private $nombres_Des;
    private $emailDet;
    private $codCategoriaDet;
    
    
    function getCodAsignacionDet() {
        return $this->codAsignacionDet;
    }

    function getCod_AsignacionCab() {
        return $this->cod_AsignacionCab;
    }

    function getCedula_Des() {
        return $this->cedula_Des;
    }

    function getNombres_Des() {
        return $this->nombres_Des;
    }

    function getEmailDet() {
        return $this->emailDet;
    }

    function getCodCategoriaDet() {
        return $this->codCategoriaDet;
    }

    function setCodAsignacionDet($codAsignacionDet) {
        $this->codAsignacionDet = $codAsignacionDet;
    }

    function setCod_AsignacionCab($cod_AsignacionCab) {
        $this->cod_AsignacionCab = $cod_AsignacionCab;
    }

    function setCedula_Des($cedula_Des) {
        $this->cedula_Des = $cedula_Des;
    }

    function setNombres_Des($nombres_Des) {
        $this->nombres_Des = $nombres_Des;
    }

    function setEmailDet($emailDet) {
        $this->emailDet = $emailDet;
    }

    function setCodCategoriaDet($codCategoriaDet) {
        $this->codCategoriaDet = $codCategoriaDet;
    }

           
}
