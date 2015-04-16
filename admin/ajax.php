<?php

require_once("lib/config.php");
require_once("lib/funcs.php");
/*
 * FUNCTIONS
 */

function logIn($user, $pass)
{
    if (!empty($user) && !empty($pass)) {
        // verifica identidad en base de datos
        require_once("lib/load.php");

        $params = array(md5($pass), $user);
        
        $query = "select  * from mimundo_users  where   password  = ? and usuario = ?";
	$usuario = DbArgenper::fetchOne($query, $params);
        if (!$usuario) {
            return "Error en Datos de Acceso! Intente de nuevo!";
        }
        $datel = date("Y-m-d H:i:s");
        $ipcliente = $_SERVER['REMOTE_ADDR'];
        
        $paramsInsert = array(
            'idlog' => NULL,
            'iduser' => $usuario['iduser'],
            'ip' => $ipcliente,
            'fecha' => $datel
        );
        DbArgenper::insert('mimundo_login_logs', $paramsInsert);
        
        ini_set("session.name", SESS_COOKIE_NAME);
        $sess_id = trim("bongo" . md5unico());

        session_id($sess_id);
        session_start();
        session_set_cookie_params(0, HOME_DIR, $_SERVER["HTTP_HOST"], 0);
        // datos primarios de la session
        $_SESSION['bsid'] = $sess_id;
        $_SESSION['guid'] = guid(0);
        $_SESSION['lastuse'] = time();
        $_SESSION['UID'] = $usuario['iduser'];
        $_SESSION['FIRST_NAME'] = $usuario['nombre'];
        $_SESSION['LAST_NAME'] = $usuario['apellido'];
        $_SESSION['EMAIL'] = $usuario['email'];
        $_SESSION['FULLNAME'] = $_SESSION['FIRST_NAME']." ".$_SESSION['LAST_NAME'];
        return "OK";
    }
    return "Error enviando datos de acceso";
}
                

/*
 * HANDLER
 */
if (isset($_POST["cmd"]) && !empty($_POST["cmd"])) {
    if (!get_magic_quotes_gpc()) {
        foreach ($_POST as $key => $value) {
            $_POST[$key] = addslashes($value);
        }
    }
    switch ($_POST["cmd"]) {
        case "login" : echo logIn($_POST["user"], $_POST["pass"]);
            break;
    }
}
?>
