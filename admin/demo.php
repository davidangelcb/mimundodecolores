<?php
ini_set("display_errors",1);
require_once("lib/config.php");
require_once("lib/funcs.php");
require_once("lib/load.php");
try{
    $SQL = "select * from configuracion"; 
    $giros = DbArgenper::fetchAll($SQL);//fetchAll
     foreach($giros as $row){
        echo "<pre>";
        print_r($row);
        echo "</pre>";    
     }        
} catch (Exception $e){
    echo $e->getTrace();
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
