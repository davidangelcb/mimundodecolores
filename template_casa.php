<?php
require_once('admin/lib/config.php');
require_once("admin/lib/funcs.php");
require_once("admin/lib/load.php");
$config = array(
    'galerySpeed'=>4,
    'galeryComentarios'=>'N',
    'nubeSpeed'=>20,
    'nube'=>'Y'
    );        
$query0 = "select *  from configuracion   limit 1";
$_conf = DbArgenper::fetchOne($query0);//
if($_conf){
    $config['galerySpeed'] =$_conf['galeryTiempo']; 
    $config['galeryComentarios'] =$_conf['galeryComentario']; 
    $config['nubeSpeed'] =$_conf['animacionnubetiempo']; 
    $config['nube'] =$_conf['animacionnube']; 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:MiMundoDeColores.Com:. - Catalogo</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/textos.css" rel="stylesheet" type="text/css" />
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/nube.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.rotate.js"></script>
<script type="text/javascript" src="js/web.js"></script>

<script>
    var TIEMPONUBE=<?php echo $config['nubeSpeed'];?>;
</script>
</head>
<body>
    <div id="principal">
        <div id="divNubes"></div>
        <?php //require_once("logito.php");?>
        <?php require_once("redes.php");?>
        <!-- AREA DE TRABAJO -->
        <div id="casaLapices">
                <img src="img/lapiz_1.png" id="lapiz1"/>
                <img src="img/lapiz_2.png" id="lapiz2"/>
                <img src="img/lapiz_3.png" id="lapiz3"/>
                <img src="img/lapiz_4.png" id="lapiz4"/>
                <img src="img/lapiz_5.png" id="lapiz5"/>
                
                <div id="puerta">
                    <div id="sombra"></div>
                    <div id="puertaAbierta"></div>
                </div>
                <div id="idVentana">
                    
                </div>
             
        </div>
        <!-- AREA DE TRABAJO -->
        <?php require_once("footer.php");?>
    </div>    
<script type="text/javascript" src="js/nubes.js"></script>
</body>
</html>