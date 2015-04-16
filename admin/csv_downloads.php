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
if(!isset($_GET['tipo'])){
    echo "Acceso denegado";
    exit;
}
function getEstado($nu,$arge){
    if($arge=='EE'){
        $msg='Envio EE';
    }elseif($arge!='XX'){
        switch((int)$nu){
            case 0: $msg= "por Procesar"; break;
            case 1: $msg= "Procesado"; break;
            case 2: $msg= "Pendiente API"; break;
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
function getEstadoInfo($estado,$api,$arge){
    if($arge=='EE'){
            $msg= "Enviado Manualmente (EE)";
    }elseif($arge!='XX'){
        switch((int)$estado){
            case 0: $msg= ""; break;
            case 1: $msg= "Enviado a MensajesOnline.pe"; break;
            case 2: $msg= "En espera por MensajesOnline.pe"; break;
            case 3: $msg= "Fallo en MensajesOnline.pe"; break;
            case 4: $msg= "Se envio Correctamente"; break;
            case 5: $msg= "Error: ".$api; break;
            default: $msg= "por Procesar"; break;
        }
    }else{
        $msg= "Ingreso como Pendiente";
    }
    return $msg;    
}
        require_once("lib/load.php");
        $tipo = (int)$_GET['tipo']; 
        $feIn = $_GET['fechaIni']; 
        $feFi = $_GET['fechaFin']; 
        $droM = (int)$_GET['dropMenu']; 
        $colu = (int)$_GET['columna']; 
        $crit = $_GET['criteria']; 
        if($tipo==1){
            $criterio ="por Estado";
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
                    $active=true;
                    require("csv_downloads_sms.php");
                    exit();
                }
                $where = " where  ".$colFecha." > '".$feIn." 00:00:00' and ".$colFecha."  < '".$feFi." 23:59:59' ".$add;
            }
        }else{
            $criterio ="por Criterio";
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
        $xdat = "#Giro, Nombre, Fecha Ingreso, Estado,Estado Info, Celular,Cod-SMS, Longitud SMS, mensaje, Fecha de Proceso, Fecha de Actualizacion,# envios , # dia EE \n";
        $SQL = "SELECT numero_envios, argenper_estado,estado_envio, numero_giro as id,  nombre_cliente ,  DATE_FORMAT(fecha_ingreso,'%m/%d/%Y %T:%S') as 'ingreso', celular_cliente, id_sms,longitud_sms, respuesta_api ,mensaje_cliente , DATE_FORMAT(fecha_proceso,'%m/%d/%Y %T:%S') as 'proceso', DATE_FORMAT(fecha_actualizacion_estado,'%m/%d/%Y %T:%S') as 'actualizacion' ,  DATE_FORMAT(num_dia_ee,'%m/%d/%Y %T:%S') as 'nndias' FROM  argenper_tblSMS  ".$where; 
        $giros = DbArgenper::fetchAll($SQL);//fetchAll
        foreach ($giros as $row) {
            $row['mensaje_cliente'] = str_replace(',', '-', $row['mensaje_cliente']);
            $row['nombre_cliente'] = str_replace(',', '-', $row['nombre_cliente']);
            $row['id'] = str_replace(',', '-', $row['id']);
            $estado=getEstado($row['estado_envio'],$row['argenper_estado']);
            $estadoInfo=getEstadoInfo($row['estado_envio'],$row['respuesta_api'],$row['argenper_estado']);
            if($row['longitud_sms']=='' || $row['longitud_sms']==0){
                $log=  strlen($row['mensaje_cliente']);
            }else{
                $log=   $row['longitud_sms'];
            }
            
            $xdat.= $row['id'] . "," . $row['nombre_cliente'] . "," . $row['ingreso']  . "," . $estado . "," . $estadoInfo . "," . $row['celular_cliente']. "," .
                    $row['id_sms'] . "," . $log . "," . $row['mensaje_cliente'] . "," . $row['proceso'] . "," . $row['actualizacion'] . "," . $row['numero_envios'] . ",".$row['nndias']."\n";
        }
       
$xdatx = stripslashes($xdat);

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"report_".$criterio.".csv\"");
echo $xdatx;
?>
