<?php

include './config.php';

$select = "SELECT * FROM mesas ORDER BY mesas.id ASC";
if($res=mysqli_query($conn, $select)){
    $id = array();
    $secao = array();
    $mesa = array();
    $status = array();
    $i = 0;

    $Nmesas = 1;

    while ($reg = mysqli_fetch_array($res)) {
        for($x = 0; $x < $Nmesas; $x++){

            if($reg['status'] == 'block'){
                echo '<div class="item"><span class="'. $reg['status'] .'">' . $reg['secao'] . $reg['mesa'] . '</span></div>';
            }elseif($reg['status'] == 'livre'){
                echo '<div class="item"><a class="'. $reg['status'] .'" href="registro?secao='. $reg['secao'] . '&mesa=' . $reg['mesa'] .'&status='. $reg['status'] .'&id='. $reg['id'] .'">' . $reg['secao'] . $reg['mesa'] . '</a></div>';
            }elseif($reg['status'] == 'hidden'){
                echo '<div class="item"><span class="'. $reg['status'] .'"></span></div>';
            }elseif($reg['status'] == 'parcial'){
                echo '<div class="item"><a class="'. $reg['status'] .'" href="registro?secao='. $reg['secao'] . '&mesa=' . $reg['mesa'] .'&status='. $reg['status'] .'&id='. $reg['id'] .'">' . $reg['secao'] . $reg['mesa'] . '</a></div>';
            }
        }
    }
}
?>