<?php
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

date_default_timezone_set('America/Lima');
// ENCODIFICACION DEL CHARSET
header("Content-Type: text/html; charset=UTF-8");
//header("Content-Type: text/html; charset=iso-8859-1\r\n");
ini_set('zend.ze1_compatibility_mode', 0);
// REPORTE DE ERRORES AL CLIENTE (para depuracion)
ini_set('error_reporting', E_ALL);
if (APPLICATION_ENV == 'production' || defined('RUN_CRON')) {
    ini_set('display_errors', '0');
} else {
    ini_set('display_errors', '1');
}    
// DATOS ADMINISTRATIVOS
defined('WEB_MASTER_MAIL') || define("WEB_MASTER_MAIL","david@mayopi.com");
// PATHS Y LINKS
defined('HOME_DIR') || define('HOME_DIR','/'); // link de inicio
defined('HOME_FS_DIR') || define('HOME_FS_DIR',$_SERVER['DOCUMENT_ROOT'].HOME_DIR); // path de inicio
// DB INFO
defined('DB_TOOL_NAME') || define("DB_TOOL_NAME","argenper");


if (APPLICATION_ENV == 'production' || defined('RUN_CRON')) {
    defined('PROTOCOL_TYPE') || define('PROTOCOL_TYPE', 'http://');
    defined('BASE_URL') || define('BASE_URL', 'http://200.4.205.214/argenpersms');

} else {
    defined('PROTOCOL_TYPE') || define('PROTOCOL_TYPE', 'http://');
    defined('BASE_URL') || define('BASE_URL', 'http://argenper.dev');
}
// SESSION
defined('SESS_COOKIE_NAME') || define("SESS_COOKIE_NAME","ARGEN_SESSID"); // nombre de la cookie de sesion
defined('SESS_TIME_EXPIRE') || define("SESS_TIME_EXPIRE",0); // mata la session antes del tiempo predeterminado (24 mins), si es 0 no lo toma en cuenta
defined('SESS_TIME_LIMIT') || define("SESS_TIME_LIMIT",40); // tiempo maximo de inactividad (mins), SESS_TIME_LIMIT > 0 siempre
//CREACION DE VARIABLE DE ESTADIA
defined('TOOL_SITE') || define("TOOL_SITE","ONLINE"); //ONLINE -- TEST
defined('PAG_BACK') || define("PAG_BACK","index.php");
// INFO MENSAJESONLINE KEYS
defined('USER_SMS') || define("USER_SMS","argenper_sms");
defined('PASS_SMS') || define("PASS_SMS","Arg3np3r8M82014");
defined('HTTP_SMS') || define("HTTP_SMS","https");
/***************************************************************************************************/
/***************************************************************************************************/
//SSOPORTE EMAIL
defined('HELP_EMAIL') || define("HELP_EMAIL","david@mayopi.com");
/***************************************************************************************************/
/***************************************************************************************************/
/*******    AREA DE CONFIGURACION DE RECORDATORIOS Y ALERTAS                              */
/***************************************************************************************************/
// CONFIGURACION ALERTA CRON
defined('CHECK_CRON') || define("CHECK_CRON","test");// test (desactivo)  live (activado)
defined('CHECK_CRON_MINUTES') || define("CHECK_CRON_MINUTES","300000");//( MINUTOS * 60 )* 1000  = default cada 5 minutos revisa el cron

// CONFIGURACION RECORDATORIO PORPROCESAR
defined('CHECK_PORPROCESAR') || define("CHECK_PORPROCESAR","test");// test (desactivo)  live (activado)
defined('CHECK_PORPROCESAR_MINUTES') || define("CHECK_PORPROCESAR_MINUTES","360000");//( MINUTOS * 60 )* 1000  = default cada 6 minutos revisa el cron

// CONFIGURACION RECORDATORIO  PENDING
defined('CHECK_PENDIN') || define("CHECK_PENDIN","test");// test (desactivo)  live (activado)
defined('CHECK_PENDIN_MINUTES') || define("CHECK_PENDIN_MINUTES","330000");//( MINUTOS * 60 )* 1000  = default cada 5 1/2 minutos revisa el cron

// CONFIGURACION RECORDATORIO  CONTADOR
defined('CHECK_PENDIN_CRON') || define("CHECK_PENDIN_CRON","test");// test (desactivo)  live (activado)
defined('CHECK_PENDIN_CRON_MINUTES') || define("CHECK_PENDIN_CRON_MINUTES","40000");//( MINUTOS * 60 )* 1000  = default cada 20 segundos

?>