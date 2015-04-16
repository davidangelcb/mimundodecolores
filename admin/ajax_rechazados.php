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

function listaDepositos($_GET)
{
        // verifica identidad en base de datos
        require_once("lib/load.php");
        $page = $_GET['page']; // get the requested page 
        $limit = $_GET['rows']; // get how many rows we want to have into the grid 
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort 
        $sord = $_GET['sord']; // get the direction 

        if(!$sidx) $sidx =1;
        
        $query = "SELECT COUNT(*) AS count from  argenper_tblSMS where   tip_entrega = 'T' and argenper_estado ='PP'  and    (estado_envio=0 or estado_envio is null  )";
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
        $SQL = "SELECT  id_ref as id,  numero_giro,  nombre_cliente,  DATE_FORMAT(fecha_ingreso,'%m-%d-%Y') as 'respuesta_api', celular_cliente,  mensaje_cliente FROM   argenper_tblSMS where    tip_entrega = 'T' and  argenper_estado ='PP'  and    (estado_envio=0 or estado_envio is null  )       ORDER BY $sidx $sord LIMIT $start , $limit"; 
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
            'mensaje_cliente' => $_POST['mensaje_cliente']
        );
        DbArgenper::update('argenper_tblSMS', $params, 'id_ref = ' . $_POST['id']);    
        $response['error'] = 0;
        $response['message'] = 'Se Actualizo la nota';
        return json_encode($response);
}
function procesa($_POST){
        require_once("lib/load.php");
        
        $ids =  $_POST['ids'] ;
        $iduser=1;
        if(isset($_SESSION['UID'])){
            $iduser=$_SESSION['UID'];
        }
        
        $SQL = "SELECT  id_ref as id,  numero_giro, argenper_estado, nombre_cliente,  DATE_FORMAT(fecha_ingreso,'%m-%d-%Y') as 'respuesta_api', celular_cliente,  mensaje_cliente FROM   argenper_tblSMS where id_ref in (".$ids.")"; 
        $giros = DbArgenper::fetchAll($SQL);//fetchAll
        $cantGiros = 0;
        $idsSend="";
        $enviados = 0;
        $pendin = 0;
        $idsFail="";
        foreach ($giros as $giro) {
            $cantGiros++;
            $nx=  strlen($giro['mensaje_cliente']);
            $datel = date("Y-m-d H:i:s");
            $resX = validacion($giro['celular_cliente'],$giro['mensaje_cliente'],$giro['argenper_estado']);
            if($resX=='P'){
                        $params = array(
                            'estado_envio'=>4,
                            'fecha_proceso' => $datel,
                            'longitud_sms'=>$nx,
                            'userid'=>$iduser,
                            'respuesta_api'=>$resX
                        );  
                        DbArgenper::update('argenper_tblSMS', $params, 'id_ref = ' . $giro['id']);  
            }else{            
                if($resX==''){
                    // send to cron
                    $params = array(
                        'userid'=>$iduser,
                        'estado_envio' => 100
                    );
                    DbArgenper::update('argenper_tblSMS', $params, 'id_ref = ' . $giro['id']);  
                    $idsSend .= ($idsSend == "") ? $giro['id'] : ",".$giro['id'];
                    $enviados++;
                }else{
                        $params = array(
                            'estado_envio'=>5,
                            'fecha_proceso' => $datel,
                            'longitud_sms'=>$nx,
                            'userid'=>$iduser,
                            'respuesta_api'=>$resX,
                            'argenper_estado'=>'XX'
                        );
                        DbArgenper::update('argenper_tblSMS', $params, 'id_ref = ' . $giro['id']);
                        $idsFail .= ($idsFail == "") ? $giro['id'] : ",".$giro['id'];
                        $pendin++;
                } 
            }
        }
        
        $paramsInsert = array(
            'idlog'=>NULL,
            'fecha'=>$datel,
            'q'=>$cantGiros,
            'ids'=>$_POST['ids'],
            'ids_done' =>$idsSend,
            'ids_fail'=>$idsFail,
            'iduser' =>$iduser,
            'estado'=>'E'

        );
        DbArgenper::insert('argenper_processlog', $paramsInsert);
        
        return "Done||".$enviados;
}
function  validacion($cel,$msg,$arg){
    if($arg=='XX'){
        return 'Argenper Validacion';
    }
    if($arg=='EE'){
        return 'P';
    }    
    if($cel==''){
        return 'Campo requerido';
    }
    if($msg==''){
        return 'Campo requerido';
    }
    if(strlen($msg)>160){
        return 'Longitud excedida('.strlen($msg).')';
    }
    $c = strlen($cel);
    if($c==9){
        $tmp = substr($cel,0,1);
        if($tmp == 9 || $tmp =='9'){
            if(preg_match('/^[0-9]{9}$/',$cel)){
                return '';
            }else{
                return 'Validacion Celular(1)';
            }
         }else{
             return 'Validacion Celular(2)';
         }
    }elseif($c==11){
        $tmp = substr($cel,0,3);
        if($tmp == 519 || $tmp =='519'){
            if(preg_match('/^[0-9]{9}$/',$cel)){
                return '';
            }else{
                return 'Validacion Celular(3)';
            }
         }else{
             return 'Validacion Celular(4)';
         }        
    }elseif($c==12){
        $tmp = substr($cel,0,4);
        if($tmp =='+519'){
            $xcel = str_replace("+", '', $cel);
            if(preg_match('/^[0-9]{9}$/',$xcel)){
                return '';
            }else{
                return 'Validacion Celular(5)';
            }
         }else{
             return 'Validacion Celular(6)';
         }
    }else{
        return 'Validacion Celular(7)';
    }
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
        case "listRecha_" : echo listaDepositos($_GET); break;
        case "edit" : echo edit($_POST); break;
        case "procesa": echo procesa($_POST); break;
    }
}
?>
