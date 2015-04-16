<?php
date_default_timezone_set('America/Los_Angeles');
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Tool .: Argenper :.</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/textos.css" rel="stylesheet" type="text/css" />
<link href="css/reset.css" rel="stylesheet" type="text/css" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script>
        $(document).ready(function() 
            {    
              $('#search2').keypress(function(e){   
               if(e.which == 13){      
                 acceso();    
               }   
              });    
              
           });        
    //var botonAcceso = '[ <span style="color: #003366;cursor: pointer;" onclick="acceso()">Ingresar</span> ]';
    var botonAcceso = '<a href="#" class="Xclassname" onclick="acceso()">Ingresar</a>';
    
    var acceso = function(){
        var loading = "<img src='media/misc/loading.gif' width='30'>";
        $("#acceso").html(loading+" Espere...");
        var user = $("#search1").val();
        var pass = $("#search2").val();
        //case "login" : echo logIn($_POST["user"], $_POST["pass"]);
        $.ajax({        
                url: 'ajax.php',        type: 'post',        
                data:{  cmd: 'login',    user: user,            pass: pass},        
                datetype: 'html',        
                    success: function(data){                    
                        if(data==="OK"){                
                            document.location.href="index_tool.php";
                        } 
                        else {
                            $("#acceso").html(botonAcceso);
                            alert(data);            
                        }        
                    }    
                });
    };
    $(window).load(function(){    
        $("#acceso").html(botonAcceso);
    });
    
</script>    
</head>

<body>
    <div id="principal">
        <div id="cabeceraInicial">
            <div class="textoBl_10" style="padding: 10px;float: right;"><b><?php echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;?></b></div>
        </div>
        <div id="cabeceraLogo">
            <div class="logo" style="padding: 10px; top:15px; position: absolute;left: 15px;"></div>
            <div class="textoBl_12" style="padding: 10px;float: right;"></div>
        </div>
        <div id="cabeceraFinal">
            <div class="textoBl_12" style="padding: 10px;float: left;"><b>Area de Acceso</b></div>
            <div class="textoBl_12" style="padding: 10px;float: right;"></div>
        </div>
        
        <div id="cuerpo">
            <div style="padding: 50px; height: 200px; width: 300px;margin: 0 auto;   ">
                <div style=" background: rgba(0, 51, 102,0.2);border-radius: 10px 10px 10px 10px;border:2px solid #003366;height: 150px;">
                    <div class="logeoTxtT">Ingresar Datos de Acceso&nbsp;</div>
                    <br></br>
                                        
                    <div class="logeoTxt" style="text-align: center;width: 100%; height: 38px;"><input id="search1" class="text" type="text" placeholder="Usuario" name="usuario"/></input></div>
                    <div style="clear: both"></div>
                    <div class="logeoTxt" style="text-align: center;width: 100%; height: 38px;"><input id="search2" class="text" type="password" placeholder="Password" name="criterio"/></input></div>
                    <div style="clear: both"></div>
                    <div class="logeoTxt">&nbsp;</div><div  class="logeoInput" id="acceso"></div>
                </div>
            </div>
        </div>
        <?php require_once 'footer.php';?>
    </div>
</body>
</html>
