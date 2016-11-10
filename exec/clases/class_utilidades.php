<?PHP
class classUtilidades{    
    static function cambiaf_a_normal($fecha){
        ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
        $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
        return $lafecha;
    }
    
    static function cambiaf_a_mysql($fecha){
        ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
        $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
        return $lafecha;
    }
    
    public static function tornaMesLletra($fecha){
        $mifecha = explode("-", $fecha);
        switch($mifecha[1]){
            case 1: return $mifecha[0]."-Gener-".$mifecha[2];
            case 2: return $mifecha[0]."-Febrer-".$mifecha[2];
            case 3: return $mifecha[0]."-Mar�-".$mifecha[2];
            case 4: return $mifecha[0]."-Abril-".$mifecha[2];
            case 5: return $mifecha[0]."-Maig-".$mifecha[2];
            case 6: return $mifecha[0]."-Juny-".$mifecha[2];
            case 7: return $mifecha[0]."-Juliol-".$mifecha[2];
            case 8: return $mifecha[0]."-Agost-".$mifecha[2];
            case 9: return $mifecha[0]."-Septiembre-".$mifecha[2];
            case 10: return $mifecha[0]."-Octubre-".$mifecha[2];
            case 11: return $mifecha[0]."-Novembre-".$mifecha[2];
            case 12: return $mifecha[0]."-Decembre-".$mifecha[2];
            default:return "";
        }
    }
    
    public static function tornaMilisTemps($temps){
        $mitemps = explode(":", $temps);
        if(count($mitemps)<2){
            $mitemps = explode(".", $temps);
        }
        if(count($mitemps)<2)
            return 0;
        $tempo = $mitemps[count($mitemps)-1];
        for($i=(count($mitemps)-2);$i>=0;$i--){
            $tempo += $mitemps[$i]*(pow(60,count($mitemps)-2-$i))*1000;
        }
        return $tempo;
    }
    
    public static function tornaTempsDesdeInt($s){
        $milis = $s%1000;
        $s /=1000;
        return date("i:s",$s).":".$milis;
    }
    
    public static function tornaIntFecha($fecha){
        $mifecha = explode("-", $fecha);
        if(count($mifecha)<3)
            $mifecha = explode("/",$fecha);
        if(count($mifecha)<3)
            return 0;
        return mktime(0,0,0,$mifecha[1],$mifecha[0],$mifecha[2]);
    }
    
     public static function tornaIntFechaIniciDia($fecha){
        $mifecha = explode("-", $fecha);
        if(count($mifecha)<3)
            $mifecha = explode("/",$fecha);
        if(count($mifecha)<3)
            return 0;
        return mktime(0,0,0,$mifecha[1],$mifecha[0],$mifecha[2]);
    }
    
    public static function tornaIntFechaFiDia($fecha){
        $mifecha = explode("-", $fecha);
        if(count($mifecha)<3)
            $mifecha = explode("/",$fecha);
        if(count($mifecha)<3)
            return 0;
        return mktime(23,59,59,$mifecha[1],$mifecha[0],$mifecha[2]);
    }
    
    public static function tornaDiaFiDeMes($mes,$anyo){
        $ultimo=date("t",mktime(0,0,0,$mes,1, $anyo));  
        return $ultimo;
    }
    
    public static function tornaIniciMes($mes,$anyo){
        return classUtilidades::tornaIntFechaIniciDia('01-'.$mes.'-'.$anyo);
    }
    
    public static function tornaFiMes($mes,$anyo){
        return classUtilidades::tornaIntFechaFiDia(classUtilidades::tornaDiaFiDeMes($mes,$anyo).'-'.$mes.'-'.$anyo);
    }
    
    public static function tornaIniciFiMes($mes,$anyo){
        $temps = array();
        $temps['inici'] = classUtilidades::tornaIniciMes($mes,$anyo);
        $temps['fi'] = classUtilidades::tornaFiMes($mes,$anyo);
        return $temps;
    }
    
    
    public static function tornaDesconte($preu,$desconte){
        $cantitat = $desconte;
        if(strpos($desconte,"%")!==FALSE){
            $percent = substr($desconte,0,-1);
            $cantitat = $preu*($percent/100);
        }
        return $cantitat;
    }
} 

?>