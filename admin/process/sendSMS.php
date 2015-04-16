<?php
require_once("../lib/config.php");
require_once("../lib/funcs.php");
require_once("../lib/load.php"); 

//captura los ID que necesitan ser actualizado
$procesa=true;
$SQL_ESTADO_ENVIO_1 = "SELECT  nombre_cliente, numero_envios, id_ref, celular_cliente, mensaje_cliente FROM argenper_tblSMS where estado_envio in (100) limit 50";
$giros = DbArgenper::fetchALL($SQL_ESTADO_ENVIO_1); //get all status 1
$ids="";
foreach($giros as $girito){
    if($ids==""){
        $ids=$girito['id_ref'];
    }else{
        $ids.=",".$girito['id_ref'];
    }
}
$datel = date("Y-m-d H:i:s");
if($ids!=""){
        $query = "update argenper_tblSMS set fecha_proceso='".$datel."' ,estado_envio=101 where id_ref in (".$ids.") ";
        DbArgenper::exec($query);    
}else{
   $procesa=false; 
}
 
$iduser=0;
if($procesa){
        $cantGiros = 0;
        $idsSend="";
        $idsFail="";
        foreach ($giros as $giro) {
            $cantGiros++;
            $nx=  strlen($giro['mensaje_cliente']);
            $datel = date("Y-m-d H:i:s");

            $msg = urlencode($giro['mensaje_cliente']);
            $url  = file_get_contents(HTTP_SMS."://api.mensajesonline.pe/sendsms?app=webservices&u=".USER_SMS."&p=".PASS_SMS."&to=".$giro['celular_cliente']."&msg=".$msg);

                $dat = trim($url);
                $res  = explode(" ",$dat);
                if(count($res)==2){
                    if($res[0]=='OK'){
                            $giroNUM = $giro['numero_envios']+1;
                            $params = array(
                                'estado_envio'=>1,
                                'fecha_proceso' => $datel,
                                'id_sms'=>$res[1],
                                'longitud_sms'=>$nx,
                                'respuesta_api'=>'Done',
                                'argenper_estado'=>'PP',
                                'numero_envios' => $giroNUM
                            );
                            DbArgenper::update('argenper_tblSMS', $params, 'id_ref = ' . $giro['id_ref']);  
                            $idsSend .= ($idsSend == "") ? $giro['id_ref'] : ",".$giro['id_ref'];
                            if($giroNUM==1){
                                $mod = 'MOD POR PROCESAR';
                            }else{
                                $mod = 'MOD PROCESADO (REENVIO)';
                            }
                            $paramsInsert = array(
                                'id'=>NULL,
                                'id_template'=>0,
                                'id_user'=>$iduser,
                                'nombres' => $giro['nombre_cliente'],
                                'celular'=>$giro['celular_cliente'],
                                'mensaje' =>$msg,
                                'fecha'=>$datel,
                                'id_sms' =>$res[1],
                                'estatus_mensaje' =>0,            
                                'log'=>'',
                                'tipo'=>$mod,
                                'id_ref'=>$giro['id_ref']
                            );
                            DbArgenper::insert('argenper_sms', $paramsInsert);
                    }else{
                            $params = array(
                                'estado_envio'=>5,
                                'fecha_proceso' => $datel,
                                'id_sms'=>$res[1],
                                'longitud_sms'=>$nx,
                                'respuesta_api'=>"Error, Contacte con en Area Soporte",
                                'argenper_estado'=>'XX'
                            );
                            DbArgenper::update('argenper_tblSMS', $params, 'id_ref = ' . $giro['id_ref']);                           
                            $idsFail .= ($idsFail == "") ? $giro['id_ref'] : ",".$giro['id_ref'];
                    }
                }else{
                            $params = array(
                                'estado_envio'=>5,
                                'fecha_proceso' => $datel,
                                'longitud_sms'=>$nx,
                                'respuesta_api'=>"Error, Contacte con en Area Soporte",
                                'argenper_estado'=>'XX'
                            );
                            DbArgenper::update('argenper_tblSMS', $params, 'id_ref = ' . $giro['id_ref']);
                            $idsFail .= ($idsFail == "") ? $giro['id_ref'] : ",".$giro['id_ref'];
                }
             
        }
}

/***********************************************************************************************/
$processName="SMS";
$queryCron = "SELECT * from  argenper_cron where proceso='".$processName."'";
$CronData = DbArgenper::fetchOne($queryCron);//
if($CronData){
    $queryUp = "update argenper_cron set fecha='".$datel."' where id in (".$CronData['id'].") ";
    DbArgenper::exec($queryUp); 
}else{ 
    $paramsInsert = array(
        'id'=>NULL,
        'fecha'=>$datel,
        'proceso'=>$processName,
        'estatus'=>'E'

    );
    DbArgenper::insert('argenper_cron', $paramsInsert);    
}
// fin proceso
?>