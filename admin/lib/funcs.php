<?php
// genera un md5 unico
function md5unico()
{
	mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
	$charid = md5(uniqid(rand(), true));
	return $charid;
}
//  Generates a Globally Unique Identifier (GUID) and returns it as a string
function guid($k=1)
{
	mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
	$charid = strtoupper(md5(uniqid(rand(), true)));
	$hyphen = chr(45); // "-"
	$uuid = substr($charid, 0, 8).$hyphen
			.substr($charid, 8, 4).$hyphen
			.substr($charid,12, 4).$hyphen
			.substr($charid,16, 4).$hyphen
			.substr($charid,20,12);
	if ($k==1)
		$uuid = chr(123).$uuid.chr(125);
	return $uuid;
}
function sessionValid()
{
    ini_set("session.name",SESS_COOKIE_NAME);
	if(isset($_COOKIE[SESS_COOKIE_NAME]))
	{
            if (!defined('SESSION_INIT')) {

                session_start();
                define('SESSION_INIT', true);
            }
		// validacion de sesion
		if( isset($_SESSION['bsid']) and ($_SESSION['bsid'] === session_id()) )
		{
			if( isset($_SESSION['guid']) and !empty($_SESSION['guid']) )
			{
			    $timeLimit = SESS_TIME_EXPIRE;
				if( !empty($timeLimit) )
				{
					// validacion de tiempo de expiracion de session
					$delay = time() - $_SESSION['lastuse'];
					if( $delay > (60*$timeLimit) )
					{
						session_unset();
						session_destroy();
						unset($_COOKIE[SESS_COOKIE_NAME]);
						return false;
					}
				}
				// todo ok
				$_SESSION['lastuse'] = time();
				return true;
			} else {
				session_unset();
				session_destroy();
				unset($_COOKIE[SESS_COOKIE_NAME]);
				return false;
			}
		} else {
			session_unset();
			session_destroy();
			unset($_COOKIE[SESS_COOKIE_NAME]);
			return false;
		}
	// hacer esto si no tiene acceso a la herramienta
	} else {
		return false;
	}
}
?>
