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
<title>.:MiMundoDeColores.Com:. - Quienes Somos</title>
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
                    <div style="text-align: center;padding-top: 65px;font-family: arial; font-size: 14px;font-weight: bold;line-height: 19px;">
                        <strong style="font-weight: bold; font-size: 20px;"> QUIENES SOMOS</strong><br/><br/>

                    La instituci&oacute;n educativa "Mi Mundo De Colores"<br/>
                    fue creada a partir de un sue&ntilde;o, ideal:<br/>
                    Brindar a sus ni&ntilde;os una educaci&oacute;n en excelencia<br/> 
                    que tenga como pilares los valores &eacute;ticos,  morales <br/>
                    y como motor el amor.<br/>
                    Es as&iacute; que  un 22 de noviembre del 2010<br/> 
                    sus profesoras llenas de sentimientos <br/>
                    de amor y de compromiso abren las puertas de este su nido <br/>
                    "Mi mundo de colores".<br/>
                    Somos concientes de la gran responsabilidad que<br/>
                    implica formar a asus ni&ntilde;os. m&aacute;s aun si nuestra misi&oacute;n<br/>
                     es brindarles una educaci&oacute;n de calidad que integre su<br/>
                    desarrollo intelectual y personal que les permita convertirse<br/>
                    enlos triunfadores del mañana; esa es nuestra visi&oacute;n.<br/><br/>

                    Promotor: Luiz Carlos Re&aacute;tegui del  &Aacute;guila.<br/>
                    Directora: Glendy Lily Re&aacute;tegui del &Aacute;guila. <br/> 
                    </div>
                </div>
             
        </div>
        <!-- AREA DE TRABAJO -->
        <?php require_once("footer.php");?>
    </div>    
<?php if($config['nube']=='Y'){?>    
<script type="text/javascript" src="js/nubes.js"></script>
<?php }?>    
</body>
</html>