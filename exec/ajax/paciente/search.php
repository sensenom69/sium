<?php
include('../../comun.php');
if(!$_SESSION['logeado']){
    die("Es necesari estar autenticat.");
}
if($_POST)
{
    $q=$_POST['searchword'];
    $sql_res=
    mysql_query("select * from client where nom like '%$q%' order by nom ASC LIMIT 5");
    while($row=mysql_fetch_array($sql_res))
        {
        $nom=$row['nom'];
        $id_client=$row['id_client'];
        $re_fname='<b>'.$q.'</b>';
        $re_lname='<b>'.$q.'</b>';
        $final_fname = str_ireplace($q, $re_fname, $nom);
        $final_lname = str_ireplace($q, $re_lname, $congnom);
        
        ?>
        <div class="display_box" align="left" onclick="$('#id_client').val(<?=$id_client;?>);$('#searchbox').val('<?=utf8_encode($nom);?>');$('#display').hide();">       
            <label >
            <?php echo $final_lname; ?>.&nbsp;
            <?php echo $final_fname; ?><br/>
            </label>
        </div>
        <?php
    }
}
else
{}
?>