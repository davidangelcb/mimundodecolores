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
<title>.:MiMundoDeColores.Com:. - Buzon</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/textos.css" rel="stylesheet" type="text/css" />
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/nube.css" rel="stylesheet" type="text/css" />
<script>
    var TIEMPONUBE=<?php echo $config['nubeSpeed'];?>;
</script>    

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript" src="js/misc.js"></script>
    <script>
        function enviarCorreo(){
            var ape  = $("#apellido").val();
            var nom  = $("#nombre").val();
            var ema  = $("#email").val();
            var tel  = $("#telefono").val();
            var dir  = $("#direccion").val();
            var com  = $("#comentario").val();
            if(ape==""){
                alert("Ingrese su Apellido, gracias!");
                return;
            }
            if(ema==""){
                alert("Ingrese su Correo, gracias!");
                return;
            }
            if(com==""){
                alert("Ingrese su Comentario, gracias!");
                return;
            }
            $("#lanza").html("<b style='font-size:10px;'>Espere...</b>");
            $.ajax({        
            url: 'ajax.php',        type: 'post',        
            data:{  cmd: 'correo',    ape :ape, nom :nom, ema: ema,tel :tel,dir :dir,com :com},        
            datetype: 'html',        
                success: function(data){                    
                    $("#lanza").html(botonAcceso);
                    if(data==="OK"){ 
                        alert("Gracias, se envio el mensaje con exito!");
                        clear();
                    }else {
                        alert(data);            
                    }        
                }    
            });
        }
        function clear(){
            $("#apellido").val("");
            $("#nombre").val("");
            $("#email").val("");
            $("#telefono").val("");
            $("#direccion").val("");
            $("#comentario").val("");
        }
        var botonAcceso = '<input type="button" value="enviar" class="enviar" onclick="enviarCorreo()"/>';
        $(window).load(function(){    
            $("#lanza").html(botonAcceso);
        });
        //<input type="button" value="enviar" class="enviar"/>
    </script>    
</head>
<body>
    <div id="principal">
        <div id="divNubes"></div>
        <?php require_once("logito.php");?>
        <?php require_once("redes.php");?>
        <div id="bodyCnt" style=" width: 100%;margin-top: 30px;">
            <div style="margin: 0 auto; width: 900px;height: 450px;">
                <div style="float: left; width: 480px;height: 450px;padding-top: 50px; ">
                    <div id="formulario">
                            <div id="contenidoForm">
                                <div class="tituloBg"><b>Email:</b></div>
                                <div class="textFieldC">info@mimundodecolores.com</div>
                                <div style="height: 15px;"></div>
                                <div class="textField"><b>Si desea enviar un comentario y/o sugerencia por favor<br>sirvase llenar el siguiente formulario</b></div>
                                <div style="height: 12px;"></div>
                                
                                <div class="fieldCnt">
                                    <div class="tituloField" style=""><b>Apellidos</b></div>
                                    <div class="textFieldA" style=""><input type="text" id="apellido" class="txt"/></div>
                                </div>
                                <div class="fieldCnt">
                                    <div class="tituloField" style=""><b>Nombre</b></div>
                                    <div class="textFieldA" style=""><input type="text" id="nombre" class="txt"/></div>
                                </div>
                                <div class="fieldCnt">
                                    <div class="tituloField" style=""><b>Email:</b></div>
                                    <div class="textFieldA" style=""><input type="text" id="email" class="txt"/></div>
                                </div>
                                <div class="fieldCnt">
                                    <div class="tituloField" style=""><b>Tel&eacute;fono:</b></div>
                                    <div class="textFieldA" style=""><input type="text" id="telefono" class="txt"/></div>
                                </div>
                                <div class="fieldCnt">
                                    <div class="tituloField" style=""><b>Direcci&oacute;n:</b></div>
                                    <div class="textFieldA" style=""><input type="text" id="direccion" class="txt"/></div>
                                </div>
                                <div class="fieldCnt">
                                    <div class="tituloField" style=""><b>Comentario</b></div>
                                    <div class="textFieldA" style=""><textarea type="text" id="comentario" class="txt"/></textarea></div>
                                </div>
                                <div class="fieldCnt">
                                    <div class="tituloFieldWhite" style=""></div>
                                    <div class="textFieldA" style="" id="lanza"></div>                        
                                </div>    
                            </div>
                        </div>                                    
                </div>
                <div style="float: right; width: 350px;height: 450px; padding-top: 70px;">
                    <div style="margin: 0 auto; width: 330px; text-align: left;font-family: arial;font-size: 13px;line-height: 15px;">
                    <center><img src="img/contactenos.png"></img></center></br></br>
                    <span class="txtContact">Tel&eacute;fono fijo: <img src="img/nothing.gif" width="5" height="1"/>261- 8558</br></span>
                    <span class="txtContact">Movistar:       <img src="img/nothing.gif" width="28" height="1"/> 975 - 390524</br></span>
                    <span class="txtContact">RPM:            <img src="img/nothing.gif" width="53" height="1"/> * 195281</br></span>
                    <span class="txtContact">RPC:             <img src="img/nothing.gif" width="58" height="1"/>987986177</br></span>
                    <span class="txtContact">Nextel:          <img src="img/nothing.gif" width="45" height="1"/>415* 8852</br></br></span>


                      <span class="txtContactB"> <b class="txtContactR">Email:</b>  nido_mimundodecolores@hotmail.com</span></br></br>

                      <span class="txtContactB"> <b class="txtContactR">Ubicaci&oacute;n:</b> Jr. Marcos Palomino (Ex Domingo Nieto)</br>
                          <img src="img/nothing.gif" width="73" height="1"/>Ref: Alt de las cuadras 19 y 20 Av. Brasil</span>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("footer.php");?>
<?php if($config['nube']=='Y'){?>    
<script type="text/javascript" src="js/nubes.js"></script>
<?php }?> 
</body>
</html>