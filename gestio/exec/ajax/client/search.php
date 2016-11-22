<?php
include('../../comun.php');
if(!$_SESSION['logeado']){
    die("Es necesari estar autenticat.");
}
if($_POST)
{
    $var_xiquet="";
    if((isset($_POST["nom"]) OR isset($_POST["nom_client"])) OR isset($_POST["nom_xiquet"])){
        $consulta = "";      
        if(isset($_POST["nom_xiquet"])){
            $var_xiquet = "_xiquet";
            $consulta = " AND xiquet=1";
            $q = $_POST["nom_xiquet"];
        }elseif(isset($_POST["nom_client"])){
            $var_xiquet = "_client";
            $q = $_POST["nom_client"];
        } 
        else{
            $q = $_POST["nom"];
        }       
        $sql_res=
        mysql_query("select * from client where nom like '%$q%' ".$consulta." order by nom ASC LIMIT 5");
    }elseif(isset($_POST["codi"]) AND isset($_POST["codi_xiquet"])){
        $consulta = "";
        if(isset($_POST["codi_xiquet"])){
            $var_xiquet = "_xiquet";
            $consulta = " AND xiquet=1";
            $q =$_POST["codi_xiquet"];
        }else{
            $q = $_POST["codi"];
        }       
        $sql_res=
        mysql_query("select * from client where id = '$q' ".$consulta);
    }
    if(!isset($_POST["id"])){
        $_POST["id"] = "id";
    }
    
    while($row=mysql_fetch_array($sql_res))
        {
        $nom=$row['nom'];
        $id=$row['id'];
        $codi =$row["codi"];
        $re_fname='<b>'.$q.'</b>';
        $final_fname = str_ireplace($q, $re_fname, $nom);
        $final_dni = $row['dni'];
        
        ?>
        <div class="display_box" align="left" onclick="$('#codi<?=$var_xiquet?>').val(<?=$codi;?>);$('#<?=$_POST["id"]?>').val(<?=$id;?>);$('#nom<?=$var_xiquet?>').val('<?=utf8_encode($nom);?>');$('#dni<?=$var_xiquet?>').val('<?=utf8_encode($final_dni);?>');$('#display').hide();">       
            <label >
            <?php echo $final_fname; ?><br/>
            <?php echo $final_dni; ?><br/>
            
            <?PHP if(isset($_POST["codi"])){
                echo "<img src='../img/fotos_clientes/".$row["imagen"].".jpg?nocache=".time()."' width='100px'/>";
            }?>
            <br />
            </label>
        </div>
        <?php
    }
}
else
{}
?>