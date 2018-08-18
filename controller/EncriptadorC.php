<?php
//Clase
class EncriptadorC {
    
    //Atributos Clase
    private $clave;
    
    //Constructor
    function __construct($clave) {
        $this->clave = password_hash($clave, PASSWORD_DEFAULT);
    }

    //Get And Set
    function getClave() {
        return $this->clave;
    }
    
}// Cierra Clase EncriptadorC.php