<?php 
require_once('lib/config.php');
require_once("lib/funcs.php");
if( sessionValid() ) {
	session_unset();
	session_destroy();
}

if( isset($_COOKIE[SESS_COOKIE_NAME]) )
	unset($_COOKIE[SESS_COOKIE_NAME]);

header("Location: http://".$_SERVER['HTTP_HOST'].HOME_DIR.'admin/');
exit;
?>