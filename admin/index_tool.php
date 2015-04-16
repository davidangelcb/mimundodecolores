<?php
require_once('lib/config.php');
require_once("lib/funcs.php");
if (!sessionValid()) {
    header("Location: index.php");
    exit;
}

require_once("lib/load.php");
        

date_default_timezone_set('America/Los_Angeles');
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Tool .: MiMundoDeColores :.</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/textos.css" rel="stylesheet" type="text/css" />
<link href="css/colors.css" rel="stylesheet" type="text/css" />
<link href="css/reset.css" rel="stylesheet" type="text/css" />


<!--link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<!--script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script-->
 <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

  
  
        <link rel="stylesheet" type="text/css" media="screen" href="jquery/css/ui-lightness/jquery-ui-1.8.9.custom.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/progressbar.css" /> 

        <script type="text/javascript" src="jquery/js/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="jquery/js/jquery-ui-1.8.9.custom.min.js"></script>

        <link rel="stylesheet" type="text/css" media="screen"  href="jquery/css/ui.jqgrid.css"/>
        <script type="text/javascript" src="jquery/js/i18n/grid.locale-en.js"></script>
        <script type="text/javascript" src="jquery/js/jquery.jqGrid.min.js"></script>
        <script type="text/javascript" src="js/process.js"></script>
        <script type="text/javascript" src="js/misc.js"></script>
        <script type="text/javascript" src="js/mundo.js"></script>
     <script type="text/javascript"> 
        function progressBar(percent, $element) {
                var progressBarWidth = percent * $element.width() / 100;
                $element.find('div').animate({ width: progressBarWidth }, 500).html(percent + "%&nbsp;");
        }    
        function updateExchangeRate(currencyBase) {
            jQuery("#exchange_rates").jqGrid('setGridParam', {
                url: "https://tools.bongous.com/pay_admin_exchange_rates.php?oper=fetchByCurrency&currency_base=" + currencyBase
            }).trigger("reloadGrid");
        }
        function closePorProcesar(){
            $("#AlertporProcesa").hide();
            stopFlashTitle();
        }
        function closePendientes(){
            $("#AlertPending").hide();
            stopFlashTitle();
        }
        function closeCron(){
            $("#AlertCron").hide();
        }
        $(document).ready(function(){  
            $('<audio id="audio_fb"><source src="media/sonido_notificacion.wav" type="audio/wav">, <source src="media/sonido_notificacion.ogg" type="audio/ogg">, <source src="media/sonido_notificacion.mp3" type="audio/mpeg"></audio>').appendTo("body");	   
        });        
     </script>        
<script>
</script>
<style>
    .ui-tooltip {
    padding: 4px 8px;
    color: #003366;
    border-radius: 3px;
    font: "Helvetica Neue", Sans-Serif;
    font-size: 10px;
    box-shadow: 0 0 7px black;
  }
    #progressbar .ui-progressbar-value {
    background-color: #ccc;
  }
</style>

</head>

<body>
    <div id="principal">
        <div id="AlertporProcesa"  class="alertaSMS" style="display: none;" onclick="closePorProcesar()">
            <div style="height: 200px;width: 100%;"></div>
            <div class="alertaTxt" style="cursor: pointer">
                <span class="alertaTxtCnt">Nuevos registros en "Por Procesar"</span>
            </div>
        </div>
        <div id="AlertPending"  class="alertaSMS" style="display: none;" onclick="closePendientes()">
            <div style="height: 200px;width: 100%;"></div>
            <div class="alertaTxt">
                <span class="alertaTxtCnt">Nuevos registros en "Pendientes"</span>
            </div>
        </div>
        <div id="AlertCron"  class="alertaSMS" style="display: none;" onclick="closeCron()">
            <div style="height: 200px;width: 100%;"></div>
            <div class="alertaTxt">
                <span class="alertaTxtCnt" id="txtCron"></span>
            </div>
        </div>
        <div id="cabeceraInicial">
            <div class="textoBl_10" style="padding: 10px;float: right;"><b><?php echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;?></b></div>
        </div>
        <div id="cabeceraLogo">
            <div class="logo" style="padding: 10px; top:15px; position: absolute;left: 15px;"></div>
            <div class="nameTool" style="padding: 5px;top:30px; position: absolute;right: 0px;"></div>
        </div>
        <div id="cabeceraFinal">
            <div class="textoBl_12" style="padding-left: 10px;float: left;line-height: 15px;"><b><img src="media/misc/user.png"></img></div>
            <div class="textoBl_12" style="padding-left: 10px;float: left;line-height: 25px;"><b> User:</b> <?php echo $_SESSION['FULLNAME'];?></div>
            <div class="textoBl_12" style="padding-right:  10px;float: right;line-height: 20px;cursor: pointer;"  onclick="logout()"> &nbsp;Cerrar Session</div>
            <div class="textoBl_12" style="float: right; cursor: pointer;"><img src="media/misc/cerrar.png"  onclick="logout()"></img></div>
            <div class="textoBl_12" style="float: right; cursor: pointer; width: 110px;padding: 5px;" id="contadorActivo"></div>
        </div>
        
        <div id="cuerpo">

            <div class="controlMenu" id="ControlMenu" style="display: block;">
                    <?php require 'modules.php';?>
            </div>
            <div id="menuody_1"  style="display: none" class="ProcesarSMS">
                <div class="ProcesarSMS_" style="position: relative">
                    <?php require 'model_1.php';?>
                </div>
            </div>
            <div id="menuody_2"  style="display: none" class="ProcesarSMS">
                <div class="ProcesarSMS_" style="position: relative">
                    <?php require 'model_2.php';?>
                </div>
            </div>
            <div id="menuody_3"  style="display: none" class="ProcesarSMS">
                <div class="ProcesarSMS_" style="position: relative">
                    <?php require 'model_3.php';?>
                </div>
            </div>
            <div id="menuody_4"  style="display: none" class="ProcesarSMS">
                <div class="ProcesarSMS_" style="position: relative">
                    <?php require 'model_4.php';?>
                </div>                 
            
            </div>
            <div id="backClose" style="display: none; position: absolute; top: 153px; left: 45px; width: 810px; height: 539px; background: rgba(0,0,0,0.5);"></div>
            <div id="formItem" style="display: none; position: absolute; top: 200px; left: 200px; width: 510px; height: 438px;background: white; border-radius: 10px 10px 10px 10px;border:5px solid #990000;">
                <?php require "form.php";?>
            </div>            
        </div>
        <?php require_once 'footer.php';?>
    </div>
 <iframe src="" name="bodycsv" id="bodycsv" style="display:none;"></iframe>    
 <input type="hidden" id="idTotalProcesados" value="0"/>
 <input type="hidden" id="idTotalPendientes" value="0"/>
  <script type="text/javascript">
  (function () {
   var titleOriginal = document.title;   
   var intervalBlinkTitle = 0;
 
   // Inicia el parpadeo del título la página
   window.startFlashTitle = function (newTitle) {       
       if(intervalBlinkTitle == 0){
        document.title = 
         (document.title == titleOriginal) ? newTitle : titleOriginal;           
 
        intervalBlinkTitle = setInterval(function (){
         document.title = 
          (document.title == titleOriginal) ? newTitle : titleOriginal;           
        }, 1000);
    } 
   };
 
   // Para el parpadeo del título de la página   
   // Restablece el título
   window.stopFlashTitle = function () {       
       clearInterval(intervalBlinkTitle);
       intervalBlinkTitle = 0;
       document.title = titleOriginal;
   };
  }());
 </script>
 <script>
    
 </script>    
 <iframe id="uploadHandler" name="uploadHandler"  style="visibility:hidden; width:1px; height:1px;" scrolling="auto" frameborder="0"></iframe>
</body>
</html>

