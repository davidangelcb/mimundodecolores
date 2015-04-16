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
<title>.:MiMundoDeColores.Com:. - Mision</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/textos.css" rel="stylesheet" type="text/css" />
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/nube.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.rotate.js"></script>
<script type="text/javascript" src="js/web.js"></script>
<script type="text/javascript" src="js/misc.js"></script>
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
                
                <img src="img/lapiz_6.png" id="lapiz6"/>
                <img src="img/lapiz_7.png" id="lapiz7"/>
                <img src="img/lapiz_8.png" id="lapiz8"/>
                <img src="img/buzon.png" id="buzon"/>
                <div id="puerta">
                    <div id="sombra"></div>
                    <div id="puertaAbierta"></div>
                </div>
                <div id="idVentana"></div>
                
                <div id="contenidoSomos">
                    <div style="text-align: center;padding-top: 100px;font-family: arial; font-size: 12px;font-weight: bold;line-height: 16px;">
                        
     
                    <strong style="font-weight: bold; font-size: 16px;">MISION</strong><br/> <br/> 

                    Promovemos el est&iacute;mulo para el desarrollo de<br/> 
                    aptitudes, habilidades y talentos en cada ni&ntilde;o, <br/> 
                    Respetando su espacio y su predisposici&oacute;n <br/> 
                    a ciertos caracteres de personalidad <br/> 
                    a trav&eacute;s de procesos integrados de ense&ntilde;anza<br/> 
                     como el uso gradual del programa Optimist <br/> 
                    con un equipo humano comprometido y competente <br/> 
                    que brinda un servicio íntegro y de excelencia.<br/> <br/> 
                    
                    <strong style="font-weight: bold; font-size: 16px;">VISION</strong><br/> <br/> 

                    Ser el Nido l&iacute;der en Lima Metropolitana <br/> 
                    al 2020,y desde &eacute;ste momento  ser aliados<br/> 
                    estrat&eacute;gicos  de los padres en la formaci&oacute;n, <br/> 
                        crecimiento y aprendizaje de sus hijos.<br/> <br/> 
                    </div>
                </div>
             
        </div>
        <!-- AREA DE TRABAJO -->
        <?php require_once("footer.php");?>
    </div>    
<?php if($config['nube']=='Y'){?>    
<script type="text/javascript" src="js/nubes.js"></script>
<?php }?>    >
</body>
</html>