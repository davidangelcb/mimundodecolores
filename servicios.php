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
<title>.:MiMundoDeColores.Com:. - Servicios</title>
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
        <?php require_once("logito.php");?>
        <?php require_once("redes.php");?>
        <div id="casaLapicesNo">
                <img src="img/buzon.png" id="buzon"/>
            <div id="contenidoSomosNo"  >
                    <div style="text-align: left;padding-top: 0px;font-family: arial; font-size: 13px;font-weight: bold;line-height: 20px;">
                        
     
                        <strong class="tituloR">1- SERVICIOS:</strong><br/> <br/> 

                        <strong class="tituloMedioR">-Nido de 1 a 5 años:</strong><br/>
                    *Cuna<br/>
                    *Estimulación temprana.<br/>
                    *Guarderia.<br/><br/>

                    <strong class="tituloMedioR">- Metodologías del Proyecto Optimist</strong><br/>
                    *Bits de lectura.<br/>
                    *Plan de valores.<br/>
                    *Conciencia fonol&oacute;gica Eco- r&iacute;tmico.<br/>
                    *Circuito neuromotor.<br/><br/>

                    <strong class="tituloMedioR">- Asesoria Psicológica permanente.</strong><br/>
                    * Evaluaciones<br/>
                    *Terapias.<br/>
                    *Atención y concentración.<br/>
                    *Lenguaje.<br/>
                    *Modificación de conducta.<br/><br/>

                    <strong class="tituloMedioR">2-Talleres todo el a&ntilde;o.</strong><br/>
                    *Ballet.-   Danza que requiere de gran concentración para el dominio  de todo <br/>
                    <img src="img/nothing.gif" width="55" height="1"/>el cuerpo.  Además  de desarrollar la flexibilidad<br/>
                    *Danza.- Desarrolla la fuerza corporal y hace que los niños puedan expresar  <br/>
                    <img src="img/nothing.gif" width="55" height="1"/>en cuerpo, alma y expresión facial cualquier tipo de sentir.<br/>
                    *karate.- Ayuda a mejorar el estado físico, coordinación  y equilibrio.<br/>
                    *Musica.- Acelera el desarrollo cerebral de los niños, ejerciendo  un efecto<br/>
                    <img src="img/nothing.gif" width="55" height="1"/> positivo sobre la memoria y la atención.<br/>
                   
                    </div>
                </div>
             
        </div>
        
        <?php require_once("footer.php");?>
    </div>    
<?php if($config['nube']=='Y'){?>    
<script type="text/javascript" src="js/nubes.js"></script>
<?php }?>    
</body>
</html>