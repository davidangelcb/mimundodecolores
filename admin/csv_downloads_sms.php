<?php
if(!isset($active)){
    exit();
}

        $feIn = $_GET['fechaIni']; 
        $feFi = $_GET['fechaFin']; 
        
        
        //'' as estado , '' as id,  '' as 'invdate',  '' as 'name', '' as 'amount',  '' as 'note'
        $where = " where  estatus_mensaje in (0,1,2,3,4)  and fecha > '".$feIn." 00:00:00' and fecha  < '".$feFi." 23:59:59'";
        
        $SQL = "SELECT  * FROM argenper_sms  ".$where; 

        
        $xdat = "#Giro, Celular, Cod-SMS, Nombre, Fecha Envio, Longitud SMS, Modulo Origen , mensaje \n";
        //$SQL = "SELECT argenper_estado,estado_envio, numero_giro as id,  nombre_cliente ,  DATE_FORMAT(fecha_ingreso,'%m/%d/%Y %T:%S') as 'ingreso', celular_cliente, id_sms,longitud_sms, respuesta_api ,mensaje_cliente , DATE_FORMAT(fecha_proceso,'%m/%d/%Y %T:%S') as 'proceso', DATE_FORMAT(fecha_actualizacion_estado,'%m/%d/%Y %T:%S') as 'actualizacion' FROM  argenper_tblSMS  ".$where; 
        $giros = DbArgenper::fetchAll($SQL);//fetchAll
        foreach ($giros as $row) {

            $lon = strlen($row['mensaje']);
            $row['mensaje'] = str_replace(',', '-', $row['mensaje']);
            
            $xdat.= $row['id_ref'] . "," . $row['celular'] . "," . $row['id_sms']  . "," . $row['nombres']  . "," . $row['fecha']  . "," . $lon. "," .
                    $row['tipo'] .  "," . $row['mensaje'] .  "\n";
        }
       
$xdatx = stripslashes($xdat);

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"report_sms_procesados.csv\"");
echo $xdatx;
?>
