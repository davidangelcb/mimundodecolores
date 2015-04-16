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
function getEstado($nu,$arge){
    if($arge=='EE'){
        $msg='Envio EE';
    }elseif($arge!='XX'){
        switch((int)$nu){
            case 0: $msg= "por Procesar"; break;
            case 1: $msg= "Procesado"; break;
            case 2: $msg= "Pendiente"; break;
            case 3: $msg= "Rechazado"; break;
            case 4: $msg= "Aprobado"; break;
            case 5: $msg= "Pendiente"; break;
            default: $msg= "por Procesar"; break;
        }
    }else{
        $msg='Pendiente';
    }
    return $msg;
}
function searchingSMS($_P)
{

        $feIn = $_P['fechaIni']; 
        $feFi = $_P['fechaFin']; 
        
        //'' as estado , '' as id,  '' as 'invdate',  '' as 'name', '' as 'amount',  '' as 'note'
        $where = " where  estatus_mensaje in (0,1,2,3,4)  and fecha > '".$feIn." 00:00:00' and fecha  < '".$feFi." 23:59:59'";
        
        $SQL = "SELECT 'Procesado' as estado , ifnull(id_ref,'-') as id,  nombres as 'invdate',  DATE_FORMAT(fecha,'%Y-%m-%d') as 'name', celular as 'amount',  mensaje as 'note'    FROM argenper_sms  ".$where; 
        $giros = DbArgenper::fetchAll($SQL);//fetchAll
        return  json_encode($giros);
}
function searching($_P)
{
        require_once("lib/load.php");
        $tipo = (int)$_P['tipo']; 
        $feIn = $_P['fechaIni']; 
        $feFi = $_P['fechaFin']; 
        $droM = (int)$_P['dropMenu']; 
        $colu = (int)$_P['columna']; 
        $crit = $_P['criteria']; 
        
        if($tipo==1){
            if($feIn=='' || $feFi==''){
                $where = " where  estado_envio in (1,2,3,4)  and fecha_proceso > '".date("Y-m-d")." 00:00:00' and fecha_proceso  < '".date("Y-m-d")." 23:59:59'";
            }else{
                $add="";
                $colFecha = "fecha_proceso";
                if($droM==1){
                    $add = " and estado_envio in (1,2,3,4)";
                }elseif($droM==2){
                    $add = " and argenper_estado ='PP'  and    (estado_envio=0 or estado_envio is null  )";
                    $colFecha = "fecha_ingreso";
                }elseif($droM==3){
                      $colFecha = "fecha_ingreso";
                    $add = " and (estado_envio in (5) or argenper_estado='XX') ";
                }elseif($droM==4){
                    $colFecha = "fecha_ingreso";
                }elseif($droM==5){
                     $add = " and estado_envio in (4)";
                }elseif($droM==6){
                     $add = " and estado_envio in (3)";
                }elseif($droM==7){
                     $add = " and estado_envio in (2)";
                }elseif($droM==8){
                    return searchingSMS($_P);
                }
                $where = " where  ".$colFecha." > '".$feIn." 00:00:00' and ".$colFecha."  < '".$feFi." 23:59:59' ".$add;
            }
        }else{
            $col="";
            if($colu==1){
                $col = " nombre_cliente ";
            }elseif($colu==2){
                $col = " celular_cliente ";
            }else{
                $col = " numero_giro ";
            }
            $where = " where   $col like '%".$crit."%' " ;
        }
        
        $SQL = "SELECT if((argenper_estado!='EE'),  if( (argenper_estado!='XX') , (case when (estado_envio = 0) then 'por Procesar' when (estado_envio=1) then 'Procesado'when (estado_envio=2)  then 'Pendiente API' when (estado_envio=3)  then 'Rechazado' when (estado_envio=4)  then 'Aprobado' when (estado_envio=5)  then 'Pendiente'  else 'por Procesar' end ) , 'Pendiente'),'Envio EE') as estado , numero_giro as id,  nombre_cliente as 'invdate',  DATE_FORMAT(fecha_ingreso,'%Y-%m-%d') as 'name', celular_cliente as 'amount',  mensaje_cliente as 'note' FROM argenper_tblSMS  ".$where; 
        $giros = DbArgenper::fetchAll($SQL);//fetchAll
        return  json_encode($giros);
}
function loadTemplate()
{
        require_once("lib/load.php");
        $SQL = "select id, titulo, sms from argenper_template where estado='E'"; 
        $templates = DbArgenper::fetchAll($SQL);
        $html='<label for="input-nombre" class="contacTitles">Template:</label><select onchange="setTemplate(this)" id="input-empresa" name="nombre" style="width: 325px;"  class="btnForm"><option value="0|||">-- Ninguno --</option>';
        foreach ($templates as $template) {
            $html.= '<option value="'.$template['id'].'|||'.$template['sms'].'" >'.$template['titulo'].'</option>';
        }
        $html.= '</select>';
        return $html;
}
function sendSMS($_P)
{
//num: num,cnt: cnt,sms: sms    
        $iduser=1;
        $idsms=0;
        if(isset($_SESSION['UID'])){
            $iduser=$_SESSION['UID'];
        }
        $datel = date("Y-m-d H:i:s");
        
        require_once("lib/load.php");
        
        $msg = urlencode($_P['sms']);
        $cel=$_P['num'];
        $url  = file_get_contents(HTTP_SMS."://api.mensajesonline.pe/sendsms?app=webservices&u=".USER_SMS."&p=".PASS_SMS."&to=".$cel."&msg=".$msg);
        $dat = trim($url);
        $res  = explode(" ",$dat);
        $pasa = true;
        $log = "";
        if(count($res)==2){
            if($res[0]=='OK'){
                $idsms=$res[1];
                $status=0;
            }else{            
                $pasa=false;
                $status=100;
                $log = $dat;
            }
        }else{
            $pasa=false;
            $status=101;
            $log = $dat;
        }
        
        
        
        $paramsInsert = array(
            'id'=>NULL,
            'id_template'=>$_P['cnt'],
            'nombres' => $_P['nom'],
            'id_user'=>$iduser,
            'celular'=>$_P['num'],
            'mensaje' =>$_P['sms'],
            'fecha'=>$datel,
            'id_sms' =>$idsms,
            'estatus_mensaje' =>$status,            
            'log'=>'',
            'tipo'=>'MOD SMS'
        );
            
        DbArgenper::insert('argenper_sms', $paramsInsert);
        if($status==0){
            return "OK";
        }else{
            return "Error enviando el mensaje, Por favor contacte con el area de Soporte.";
        }
}
function maxNews()
{
    require_once("lib/load.php");
    if(CHECK_PORPROCESAR=='live'){    
        $query = "SELECT COUNT(*) AS countx from  argenper_tblSMS where  argenper_estado ='PP'  and    (estado_envio=0 or estado_envio is null  )";
        $dataTotal = DbArgenper::fetchOne($query);//
        $nNews = $dataTotal['countx']; 
        return $nNews; 
    }
    return "0";
}
function maxPendientes()
{
    require_once("lib/load.php");
    if(CHECK_PENDIN=='live'){
        $query = "SELECT count(*) as countx from  argenper_tblSMS where estado_envio=5  or argenper_estado='XX'";
        $dataTotal = DbArgenper::fetchOne($query);//
        $nPend = $dataTotal['countx']; 
        return $nPend; 
     }
     return "0";
}
function cronApp()
{
    require_once("lib/load.php");
    if(CHECK_CRON=='live'){
        $query = "select format(now()-fecha,0) as sc,now(),fecha from argenper_cron where proceso ='SMS' and   now()-fecha  >900";
        $dataTotal = DbArgenper::fetchOne($query);//
        if($dataTotal){
          return "<b style='font-size:9px;'>Server Cron SMS Error. contacte a(".HELP_EMAIL.")</b>";  
        }
        $query2 = "select  count(id_ref) as nn from argenper_tblSMS where estado_envio in (101) and   now()-fecha_proceso  >800";
        $dataTotal2 = DbArgenper::fetchOne($query2);//
        if($dataTotal2){
            if((int)$dataTotal2['nn']>0){
              return "<b style='font-size:9px;'>Contacte a (".HELP_EMAIL."),SMS Server Error</b>";  
            }    
        }    
    }
    return "OK"; 
}
function cronProcesando()
{
    require_once("lib/load.php");
    if(CHECK_PENDIN_CRON=='live'){
        $query2 = "select  count(id_ref) as Countt  from argenper_tblSMS where estado_envio in (101)";
        $dataTotal2 = DbArgenper::fetchOne($query2);//
        if($dataTotal2){
          return $dataTotal2['Countt'];  
        }
    }    
    return "0"; 
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
        case "searching": echo searching($_POST); break;
        case "loadTemplate": echo loadTemplate(); break;
        case "sendSMS": echo sendSMS($_POST); break;
        case "maxNews": echo maxNews(); break;
        case "cronApp": echo cronApp(); break;
        case "cronProcesando": echo cronProcesando(); break;
    }
}
?>
