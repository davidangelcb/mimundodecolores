<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Tool .: Argenper :.</title>
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
 </script>
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
 
</head>
<body>
 <button onclick="startFlashTitle('Hi, Joe !!!');">
  Start
 </button>
 <button onclick="stopFlashTitle();">
  Stop
 </button>
</body>
</html>