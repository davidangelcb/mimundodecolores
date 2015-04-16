<?php

require_once("lib/config.php");
require_once("lib/funcs.php");
/*
 * FUNCTIONS
 */
if (!sessionValid()) {
    echo "Error Session Lost, Please Login Again";
    exit;
}
function listPen($_GET)
{
        // verifica identidad en base de datos
        require_once("lib/load.php");
        $page = $_GET['page']; // get the requested page 
        $limit = $_GET['rows']; // get how many rows we want to have into the grid 
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort 
        $sord = $_GET['sord']; // get the direction 

        if(!$sidx) $sidx =1;
        
        $query = "SELECT COUNT(*) AS count from  argenper_tblSMS where estado_envio=5  or argenper_estado='XX' ";
	$dataTotal = DbArgenper::fetchOne($query);//

        $count = $dataTotal['count']; 
        if( $count >0 ) { 
            $total_pages = ceil($count/$limit); 
        } else { 
            $total_pages = 0; 
        }
        if ($page > $total_pages){ $page=$total_pages; }
        if( $count >0 ) { 
            $start = $limit*$page - $limit; // 
        }else{
            $start = 0; // do not put $limit*($page - 1) 
        }

        $SQL = "SELECT  id_ref as id,  numero_giro,  nombre_cliente,  respuesta_api, celular_cliente,  mensaje_cliente FROM   argenper_tblSMS where estado_envio=5   or argenper_estado='XX' ORDER BY $sidx $sord LIMIT $start , $limit"; 
        // Error: Tamaño mensaje(150)
        // Error: Verificacion Celular 
        // Error: Argenper Validacion 

        //$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error()); 
        $giros = DbArgenper::fetchAll($SQL);//fetchAll
        
        $response->page = $page; 
        $response->total = $total_pages; 
        $response->records = $count; 
        $i=0;
        foreach($giros as $row){
            $response->rows[$i]['id']=$row['id']; 
            $response->rows[$i]['cell']=array('',$row['numero_giro'],$row['nombre_cliente'],$row['respuesta_api'],$row['celular_cliente'],$row['mensaje_cliente']); 
            $i++; 
        }

        return json_encode($response);
}
function edit($_POST){
        require_once("lib/load.php");
        
        $params = array(
            'celular_cliente' => $_POST['celular_cliente'],
            'mensaje_cliente' => $_POST['mensaje_cliente'],
            'argenper_estado'=>'PP'
        );
        DbArgenper::update('argenper_tblSMS', $params, 'id_ref = ' . $_POST['id']);    
        $response['error'] = 0;
        $response['message'] = 'Se Actualizo la nota';
        return json_encode($response);
}
function procesa($_POST){
        require_once("lib/load.php");
        
        $ids =  $_POST['ids'] ;
        
        $query = "update argenper_tblSMS set estado_envio=0 where id_ref in (".$ids.") ";
        DbArgenper::exec($query);
                
        return "Done";
}
/*
 * HANDLER
 */
if (isset($_REQUEST["oper1"]) && !empty($_REQUEST["oper1"])) {
    if (!get_magic_quotes_gpc()) {
        foreach ($_REQUEST as $key => $value) {
            $_REQUEST[$key] = addslashes($value);
        }
    }
    switch ($_REQUEST["oper1"]) {
        case "listPen_" : echo listPen($_GET); break;
        case "edit" : echo edit($_POST); break;
        case "procesa": echo procesa($_POST); break;
    }
}
?>
