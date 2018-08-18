<?php

$fh = new FechaHoraActualC();
//echo $fh->getFechaHora()."<br>";
//echo $fh->getFecha()."<br>";
//echo $fh->getHora()."<br>";

class FechaHoraActualC{

    //Atributo fechaHora
    private $arrayFechaHora;
    
    //Atributos fecha
    private $dia;
    private $mes;
    private $anio;
    
    //Atributos hora
    private $seg;
    private $min;
    private $hr;

    //Atributos fecha y hora
    private $fechaHora;
    private $fecha;
    private $hora;

    function __construct() {
        
        $this->arrayFechaHora = getdate();
        //
        $this->dia = $this->arrayFechaHora['mday'];
        $this->mes = $this->arrayFechaHora['mon'];
        $this->anio = $this->arrayFechaHora['year'];
        //
        $this->seg = $this->arrayFechaHora['seconds'];
        $this->min = $this->arrayFechaHora['minutes'];
        $this->hr = $this->arrayFechaHora['hours'];

	}// cierra constructor

    //Metodos
    public function getFechaHora(){
        
        $this->fechaHora=$this->anio."/".$this->mes."/".$this->dia." ".$this->hr.":".$this->min.":".$this->seg;

        return $this->fechaHora;        

    }//cierra metodo getFechaHora()

    public function getFecha(){
        
        $this->fecha=$this->anio."/".$this->mes."/".$this->dia;
        return $this->fecha;        

    }//cierra metodo getFecha()
    
    public function getHora(){
        
        $this->hora=$this->hr.":".$this->min.":".$this->seg;
        return $this->hora;        

    }//cierra metodo getHora()



}// Cierra clase FechaHoraActual