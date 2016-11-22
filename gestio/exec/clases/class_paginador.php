<?php
class Paginador{
    //atributs
    public $objecte;
    public $objecte_pare;
    public $elements_x_pagina;
    public $pagina_ir;
    public $cantitat_numeros_mostrar;
    public $condicions;
    public $numero_elements_relacio;
    //constructor
    function __construct($objecte,$objecte_pare,$condicions="",$pagina_ir=0,$elements_x_pagina=10,$cantitat_numeros_mostrar=5){
        $this->objecte              = $objecte;
        $this->objecte_pare         = $objecte_pare;
        $this->condicions           = $condicions;
        $this->elements_x_pagina    = $elements_x_pagina;   
        $this->pagina_ir            = $pagina_ir;
        $this->cantitat_numeros_mostrar = $cantitat_numeros_mostrar;
        $this->numeroElementsRelacio();
    }
    
    function numeroElementsRelacio(){
        $this->numero_elements_relacio = $this->objecte_pare->numeroElementosRelacion($this->objecte,"id",$this->condicions);
    }
    
    function getNumeroPagines(){
        return ceil($this->numero_elements_relacio/$this->elements_x_pagina);
    }
    
    function getCantitatNumerosMostrar(){
        return $this->cantitat_numeros_mostrar;
    }
    
    function getNumeroInicial(){
        $numero_inicial = 1;
        $mitat_numeros_mostrar = ceil($this->cantitat_numeros_mostrar/2);
        if($this->pagina_ir >= $mitat_numeros_mostrar){
            if($this->pagina_ir>=$this->getNumeroPagines()-$mitat_numeros_mostrar){
                $numero_inicial = $this->getNumeroPagines()-$mitat_numeros_mostrar-1;
            }else{
                $numero_inicial = $this->pagina_ir - $mitat_numeros_mostrar;
            }
            if($numero_inicial==0)
                    $numero_inicial = 1;
        }
        return $numero_inicial;
    }
}
?>