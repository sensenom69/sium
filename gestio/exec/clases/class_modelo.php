<?php
class Modelo{
    //atributs
    public $datos;
    public $camps;
    public $tabla;
    public $cargas;
    public $campo_carga="id";
    public $funcions;
    //constructor
    function __construct($tabla,$dades = array()){
        $this->datos = $dades;
        $this->tabla = $tabla;
        if(isset($dades['id']) AND $dades['id']<0){
            $this->datos['id'] = $this->insertarBd($dades);
        }
        $incluits = get_included_files(); 
        foreach($incluits AS $incluit){
            if(strpos($incluit,"class_".$tabla.".php")!==FALSE){
                $this->funcions = new $tabla($this);
            }
        }           
    }
    
    //cargador
    function carga($dada="id",$condicions=""){
        
        $this->campo_carga = $dada;
        $sql = "SELECT * 
                FROM ".$this->tabla." 
                WHERE 
                    ".$dada." = '".addslashes($this->datos[$dada])."' 
                    ".$condicions."
                    ";            
        //print $sql."<br>";
        $res = mysql_query($sql);
        if(mysql_affected_rows()==0)
            return 0;
        while($dades = mysql_fetch_array($res)){
            $this->datos = $dades;
        }
        return $this->datos;
    }
    //getter
    private function getTabla(){
        return $this->tabla;
    }
    public function get($dades=""){
         if(!isset($this->datos[0])){
            //print "entra per ".$this->tabla."<br>";
            $this->carga($this->campo_carga);          
         }
        if(count($dades)==0 OR $dades==""){
            if(!isset($this->datos[0]))
                    $this->carga($this->campo_carga);
            return $this->datos;
        }elseif(!is_array($dades)){
            if(!isset($this->datos[$dades]))
                    $this->carga($this->campo_carga);
            return isset($this->datos[$dades])? $this->datos[$dades]:"";
        }         
        elseif(count($dades)==1){
            if(!isset($this->datos[$dades[0]]))
                    $this->carga($this->campo_carga);
            return isset($this->datos[$dades[0]])? $this->datos[$dades[0]]:"";
        }
        else{
            $retorno = array();
            foreach($dades AS $dada){
                $retorno[$dada] = isset($this->datos[$dada])? $this->datos[$dada]:"";
            }
            return $retorno;
        }
        return "";
    }
    //setter
    function set($dades = array()){
        $sql = "UPDATE ".$this->tabla." 
                SET ".$this->tornaCadenaEditar($dades)."
                WHERE 
                    id = '".$this->datos['id']."'";
        //print $sql;
        mysql_query($sql);
        $this->carga();
    }
    //Borrador
    function del(){
        $sql = "DELETE FROM ".$this->tabla." 
                WHERE 
                    id='".$this->datos['id']."'";
        //print $sql;
        mysql_query($sql);
    }
    //cargador de relaciones    
    function cargaRelacion($objecte,$variable="id",$orden="",$condicions="",$desde=0,$quants=0){
        //$obj = new $objecte(array());
        if(class_exists($objecte))
            $obj = new $objecte(array());
        else
            $obj = new Modelo(strtolower($objecte));
        $obj->cargaCamps();       
        if(!in_array($variable,$obj->getCamps()))
            $variable = "id";
        $tabla = $obj->getTabla();
        $this->cargas[$tabla] = array();  
        $sql = "
            SELECT * FROM ".$tabla."            
            ".(($obj->tabla == $this->tabla AND $condicions=="")? "":"WHERE")."
            ".($obj->tabla == $this->tabla? " ".$condicions:(" id_".$this->tabla." = '".addslashes($this->datos['id'])."' ".$condicions))."
            ".(($variable=="")?"":"ORDER BY ".$variable." ".($orden==""?"DESC":$orden))." 
            ".(($desde==0 AND $quants==0)? "" :"LIMIT ".$desde.",".$quants)." ";
        //print $sql;
        $res = mysql_query($sql);
        if(mysql_affected_rows()==0)
            return array();
        while($datos = mysql_fetch_array($res)){
            if(class_exists($objecte))
                $this->cargas[$tabla][$datos['id']] = new $objecte($datos);
            else
                $this->cargas[$tabla][$datos['id']] = new Modelo(strtolower($objecte),$datos);
        }
        mysql_free_result($res);
        return $this->cargas[$tabla];
    }
    
    function cargaRelacionConDatos($objecte,$variable="id",$orden="",$condicions="",$desde=0,$quants=0){
        if(class_exists($objecte))
            $obj = new $objecte(array());
        else
            $obj = new Modelo(strtolower($objecte));
        $obj->cargaCamps();       
        if(!in_array($variable,$obj->getCamps()))
            $variable = "id";
        $tabla = $obj->getTabla();
        $this->cargas[$tabla] = array();  
        $identificadors = array();  
        $sql = "
            SELECT ";
        foreach($obj->getCamps() AS $camp){
            $sql .= "`".$tabla."`.`".$camp."`,";
            $id = explode("id_",$camp);
            if(count($id)>1){
                $identificadors[]=array($camp,$id[1]);
                //$sql .= "`".$id[1]."`.`nombre` as `".$id[1].".nombre` ,";
                $sql .= "`".$id[1]."`.`nom` as `".$id[1]."` ,";//HE llevat aso per que n totes les tables tenen nom
            }
        }
        $sql = substr($sql,0,-1);
        $sql .= " FROM ".$tabla.",";
        $identifi = "";
        $contador_id = 0;
        foreach($identificadors AS $id){
            $sql .= "`".$id[1]."`,";
            $identifi .= ($contador_id==0?"": " AND ")."`".$tabla."`.`".$id[0]."` = `".$id[1]."`.`id` ";
            $contador_id++;
        }
        $sql = substr($sql,0,-1);
//ojo que he posat el where tambe en el primer condicionant pa que fasa el de id_local
        //$sql .= (($obj->tabla == $this->tabla AND $condicions=="")? " WHERE ".$this->tabla.".id_local=".$_SESSION["id_local"]:" WHERE ")." 
        //$sql .= (($obj->tabla == $this->tabla AND $condicions=="")? " " : " WHERE ".$identifi." AND ")."
        $sql .= (($obj->tabla == $this->tabla AND $condicions=="")? (($identifi=="")? "": " WHERE ".$identifi." ") : (($identifi=="")? " WHERE " :" WHERE ".$identifi." AND "))."
            ".($obj->tabla == $this->tabla? " ".$condicions : ($tabla.".id_".$this->tabla." = '".addslashes($this->datos['id'])."' ".$condicions));
        //$sql .=(($obj->tabla == $this->tabla AND $condicions=="")? "":$identifi);
            //$sql .=(($condicions=="")? " WHERE ": " AND ").$identifi; //////////////////////////////////Acabe de llevar esta per que fallava en el concert
        $sql .= (($variable=="")?"":"ORDER BY ".$obj->tabla.".`".$variable."` ".($orden==""?"DESC":$orden))." 
            ".(($desde==0 AND $quants==0)? "" :"LIMIT ".$desde.",".$quants)." ";
        //print $sql."<br>";
        $res = mysql_query($sql);
        if(mysql_num_rows($res)==0)
            return array();
        while($datos = mysql_fetch_array($res)){
            if(class_exists($objecte))
                $this->cargas[$tabla][$datos['id']] = new $objecte($datos);
            else
                $this->cargas[$tabla][$datos['id']] = new Modelo(strtolower($objecte),$datos);
        }
        mysql_free_result($res);
        return $this->cargas[$tabla];
    }
    
    function numeroElementosRelacion($objecte,$variable,$condicions=""){
        $numero = 0;
        //$obj = new $objecte(array());
        if(class_exists($objecte))
            $obj = new $objecte(array());
        else
            $obj = new Modelo($objecte);
        $tabla = $obj->getTabla();
        $this->cargas[$tabla] = array();     
        $sql = "
            SELECT count(".$variable.") AS num FROM ".$tabla." 
            ".((($obj->tabla==$this->tabla) AND $condicions=="")? "":"WHERE")."
            
            ".(($obj->tabla==$this->tabla)? "":"id_".$this->tabla." = '".addslashes($this->datos['id'])."'")." 
            ".$condicions."
        ";
        
        $res = mysql_query($sql);
        
        while($datos = mysql_fetch_array($res)){
            $numero = $datos["num"];
        }
        mysql_free_result($res);
        return $numero;
    }
    
    //modificadors
    private function insertarBd($dades = array()){
        $this->cargaCamps();
        $cadenes = $this->tornaCadenesInsertar($dades);  
        $sql = "INSERT INTO ".$this->tabla." (".$cadenes['noms'].") VALUES (".$cadenes['valors'].")";
        //print $sql;
        $res = mysql_query($sql);
        return mysql_insert_id();
    }
    
    function cargaCamps(){
        $res = mysql_query('describe '.$this->tabla);
        $camps = array();
        while($camp = mysql_fetch_array($res)){
            $camps[] = $camp['Field'];
        }
        $this->camps = $camps;
    }
    
    function getCamps($canvis = ""){
        /*if(count($canvis)==0 || $canvis==""){
            return $this->camps;
        }
        $camps = $this->camps;
        foreach($canvis AS $key=>$val){
            if(($clau = array_search($key,$camps)) !== null){
                $camps[$clau] = $val;
            }
        }
        return $camps;
        */
        return $this->camps;
    }
    
    function afegixCampsNoBd($dades = array()){
        $this->datos = array_merge($this->datos,$dades);
    }
    
    private function tornaCadenesInsertar($dades = array()){
        $cadenes = array("noms"=>"","valors"=>"");
        foreach($dades AS $key => $val){
            if(in_array($key,$this->camps) AND $key!='id'){
                $cadenes['noms'] .= "`".$key."`,"; 
                $string = "'";
                switch($key){
                    //case "data": $string.= ($val!=0? "0":time())."',";break;
                    case "fecha":$string.= addslashes(classUtilidades::tornaIntFecha($val))."',";break;
                    default: $string.= addslashes($val)."',";
                }
                $cadenes['valors'] .= $string;
                //$cadenes['valors'] .= "'".($cadenes['valors']!="data"? addslashes($val):($val!=0? "0":time()))."',"; 
            }  
        }
        /*
        if(!in_array('data',$dades) AND in_array('data',$this->camps)){
            $cadenes['noms'] .= "data,";  
            $cadenes['valors'] .= time();
        }
        */
        $cadenes['noms'] = substr($cadenes['noms'],0,-1);
        $cadenes['valors'] = substr($cadenes['valors'],0,-1);
        return $cadenes;
    }
    
    private function tornaCadenaEditar($dades = array()){
        $cadena = "";
        if(count($this->camps)==0)
            $this->cargaCamps();
        foreach($dades AS $key=>$val){
            if(in_array($key,$this->camps) AND $key!='id'){
                if(stripos($key,'fecha') !== FALSE){
                    $cadena.= "`".$key."` = '".addslashes(classUtilidades::tornaIntFecha($val))."'".",";
                }else{
                    $cadena.= "`".$key."` = '".addslashes($val)."'".",";
                }              
            }  
        }
        return substr($cadena,0,-1);
    }
	
}
?>