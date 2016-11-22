<?PHP
class conter_moviment{
    public $pare;
    
    function __construct($pare){
        $this->pare = $pare;
        if($this->pare->get("orige")!=1){
            $orige = new Modelo("conter", array("id_local"=>$this->pare->get("id_local"),"id"=>$this->pare->get("orige")));
            $orige->set(array("cantitat"=>($orige->get("cantitat")-$this->pare->get("cantitat"))));
        }
        $desti = new Modelo("conter", array("id_local"=>$this->pare->get("id_local"),"id"=>$this->pare->get("desti")));
        $desti->set(array("cantitat"=>($desti->get("cantitat")+$this->pare->get("cantitat"))));
    }
   
}
?>