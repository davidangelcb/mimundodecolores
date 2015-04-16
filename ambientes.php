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
    $config['galeryComentarios'] =$_conf['ambienteComentario']; 
    $config['nubeSpeed'] =$_conf['animacionnubetiempo']; 
    $config['nube'] =$_conf['animacionnube']; 
}
 
$query = "select * from mimundo_galeria where estado='E' and tipo='AMBIENTE'";
$giros = DbArgenper::fetchAll($query);//fetchAll
$galeria = "";
$num = 1;
foreach($giros as $row){
     $row['nombre'] = utf8_decode($row['nombre']);
     $row['descri'] = utf8_decode($row['descri']);
    $add="";
if($config['galeryComentarios']=='Y'){
$add  = <<<SQLSQL
    <div class="footBg">
                    <div>{$row['nombre']}</div>
                    <span >{$row['descri']}</span>
    </div>
SQLSQL;
}
     
$galeria .= <<<SQLHTLM
<div class="slide{$num}" style="">
    <center><img src="galeria/thumb_{$row['imagenamenew']}"   alt="" /></center>
    {$add}
</div>
SQLHTLM;
$num++;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:MiMundoDeColores.Com:. - Ambientes</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/textos.css" rel="stylesheet" type="text/css" />
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/nube.css" rel="stylesheet" type="text/css" />
<link href="css/slider.css" rel="stylesheet" type="text/css"/>
<!--script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script-->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/slider.js"></script>
<script type="text/javascript" src="js/misc.js"></script>
<script>
    var TIEMPONUBE=<?php echo $config['nubeSpeed'];?>;
</script>    
<style>
	.footBg{
		position:absolute;
		background:rgba(0,0,0,0.5);
		height:65px;
                top:335px;
                left: 0px;
                width: 100%;
		font-family:Verdana, Geneva, sans-serif;
	}
	.footBg span{
		float:left;
		margin-left: 15px;
		margin-top:30px;
		color:white;
		z-index:15222;
		font-size:10px;	
		text-decoration:none;	
                text-align:left;
                width: 100%;
	}
	.footBg div{
		float:left;
                width: 100%;
		color:white;
		font-size:15px;
		font-weight:bold;
                z-index: 31233;
                text-align:left;
	}    
</style>
</head>
<body>
    <div id="principal">
        <div id="divNubes"></div>
        <?php require_once("logito.php");?>
        <?php require_once("redes.php");?>
        
        <div id="bodyCnt" style=" width: 100%;margin-top: 30px;">
            <div style="width: 780px; height:434px;  margin: 0 auto;">
                
                <div class="slider-wrapper" style=" background-image:url(img/pizarra.png); width:788px; height:434px;text-align:center;">

                        <div id="slider" style="margin: 0 auto; width:672px;padding-top:17px; height:400px;text-align:center;">
                            <?php echo $galeria;?>
                        </div>
                        <div id="slider-direction-nav"></div>
                 </div>                
            </div>
        </div>
        <?php require_once("footer.php");?>
    </div>
<?php if($config['nube']=='Y'){?>    
<script type="text/javascript" src="js/nubes.js"></script>
<?php }?>    
<script type="text/javascript">
$(document).ready(function() {
    var slider = $('#slider').leanSlider({
        directionNav: '#slider-direction-nav',
        controlNav: '#slider-control-nav',
        pauseTime: <?php echo $config['galerySpeed']*1000;?>
    });
});
</script>
</body>
</html>
