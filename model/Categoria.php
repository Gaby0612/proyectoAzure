<?php


/**
 * Description of Categoria
 *
 * @author Gaby
 */
class Categoria {
    private $codCategoria;
    private $categoria;
    
    function getCodCategoria() {
        return $this->codCategoria;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function setCodCategoria($codCategoria) {
        $this->codCategoria = $codCategoria;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }




}
