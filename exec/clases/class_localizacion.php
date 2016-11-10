<?php
	class Localizacion{
	   public static function get($tabla,$dades = array(),$ids = array()){
	       $sql = "SELECT";
           foreach($dades AS $dada){
                $sql .= " ".$dada.",";
           }
           $sql = substr($sql,0,-1)." FROM ".$tabla;
           if(count($ids)>0){
                $sql .= " WHERE";
                foreach($ids AS $key =>$val){
                    $sql .= " ".$key."='".addslashes($val)."' AND";
                }
                $sql = substr($sql,0,-3);
           }
           $res = mysql_query($sql);
           $retorno = array();
           while($dato = mysql_fetch_array($res)){
                $retorno[] = $dato;
           }
           if(count($retorno)==1)
            return $retorno[0];
           return $retorno;
	   }
	}
?>