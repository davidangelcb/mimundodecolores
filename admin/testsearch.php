<?php

?>
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
<link rel="stylesheet" type="text/css" media="screen" href="css/progressbar.css" /> 
        <link rel="stylesheet" type="text/css" media="screen" href="jquery/css/ui-lightness/jquery-ui-1.8.9.custom.css" />

        <script type="text/javascript" src="jquery/js/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="jquery/js/jquery-ui-1.8.9.custom.min.js"></script>

        <link rel="stylesheet" type="text/css" media="screen"  href="jquery/css/ui.jqgrid.css"/>
        <script type="text/javascript" src="jquery/js/i18n/grid.locale-en.js"></script>
        <script type="text/javascript" src="jquery/js/jquery.jqGrid.min.js"></script>
  
          
          
     <script type="text/javascript"> 
        function progressBar(percent, $element) {
                var progressBarWidth = percent * $element.width() / 100;
                $element.find('div').animate({ width: progressBarWidth }, 500).html(percent + "%&nbsp;");
        }
  
        function updateExchangeRate() {
          //jQuery("#list7").jqGrid('setGridParam',{page:2,cosa:1}).trigger("reloadGrid");
           // jQuery("#list7").jqGrid('setGridParam',{url:"server.php?q=1&page=5"}).trigger("reloadGrid");
            var s; 
            s = jQuery("#list7").jqGrid('getGridParam','selarrrow');
            if(s===''){
                alert("Seleccione como minimo 1 registro!");
                return;
            }
            //var idss = s.split(",");
            var ids = "";
            for(var i=0; i<s.length;i++){
                var nn= parseInt(s[i]); 
                if(nn>0){
                    if(ids==''){
                        ids+=nn;
                    }else{
                        ids+=","+nn;
                    }
                }
            }
            muestraAlertas(0);
            //jQuery("#list7").jqGrid('setGridParam',{page:2,cosa:1}).trigger("reloadGrid");
            
             $.ajax({        
                url: 'ajax_news.php',        type: 'post',        
                data:{  
                oper1: 'procesa',    ids: ids},        
                datetype: 'html',        
                    success: function(data){     
                        
                        if(data==="Done"){                
                            //document.location.href="index_tool.php";
                            progressBar(100, $('#progressBar'));
                            $('#msgAlert').html("<b style='color:green;'>Se proceso Todos los pedidos</b>");
                            jQuery("#list7").jqGrid('setGridParam',{page:1}).trigger("reloadGrid");
                            setTimeout("muestraAlertas(1)",4000)
                        } 
                        else {
                            muestraAlertas(1);
                            alert('Error en el proceso, Intente luego!');            
                        }        
                    }    
                });
        } 
        function muestraAlertas(opt){
            if(opt===1){
                $("#bloqueo").hide();
                progressBar(0, $('#progressBar'));
            }else{
                $("#bloqueo").show();
                progressBar(20, $('#progressBar'));
            }
        }
        $(window).load(function(){
          jQuery("#list4").jqGrid({ datatype: "local", height: 250, colNames:['Inv No','Date', 'Client', 'Amount','Tax','Total','Notes'], colModel:[ {name:'id',index:'id', width:60, sorttype:"int"}, {name:'invdate',index:'invdate', width:90, sorttype:"date"}, {name:'name',index:'name', width:100}, {name:'amount',index:'amount', width:80, align:"right",sorttype:"float"}, {name:'tax',index:'tax', width:80, align:"right",sorttype:"float"}, {name:'total',index:'total', width:80,align:"right",sorttype:"float"}, {name:'note',index:'note', width:150, sortable:false} ], multiselect: true, caption: "Manipulating Array Data" });
        });
        function sabe(n){
            if(n==1){
                    var mydql  = [ {"id":"55555","invdate":"David Caa","name":"02-01-2014","amount":"917987987","note":"como esats"},{"id":"55555","invdate":"David Caa","name":"02-02-2014","amount":"917987987","note":"como esats"},{"id":"55555","invdate":"David Caa","name":"08-02-2014","amount":"917987987","note":"como esats"},{"id":"65465","invdate":"Juan Jose Caa","name":"08-01-2014","amount":"999666777","note":"como esats"},{"id":"65465","invdate":"Juan Jose Caa","name":"08-01-2014","amount":"999666777","note":"como esats"}];
                    var mydata = [ {id:"1",invdate:"2007-10-01",name:"test",note:"note",amount:"200.00",tax:"10.00",total:"210.00"}, {id:"2",invdate:"2007-10-02",name:"test2",note:"note2",amount:"300.00",tax:"20.00",total:"320.00"}]; 
                    for(var i=0;i<=mydata.length;i++) jQuery("#list4").jqGrid('addRowData',i+1,mydata[i]);                
            }else{
                    var objArray5 = [];
                    jQuery("#list4").clearGridData(true).trigger("reloadGrid").addRowData('id',objArray5);            
            }
        }
        </script>        
        
<style>
  #progressbar .ui-progressbar-value {
    background-color: #ccc;
  }
  </style>
</head>

<body>
    <input type="button" onclick="updateExchangeRate()" value="okok">
    <input type="button" onclick="sabe(1)" value="okok 1">
    <input type="button" onclick="sabe(2)" value="okok 2">
    <div id="principal" style="position: relative:">
        <div style="position: absolute; background: rgba(0, 0, 0,0.4); width: 800px; height: 385px;z-index: 65465;display: none;" id="bloqueo">
            <br><br>
            <div style="clear: both"></div>
                <div style="font-size: 12px;width: 300px; margin-top: 100px;   margin: 0 auto; border-radius: 9px 9px 9px 9px;background-color: white; padding: 50px;" >
                    <span id="msgAlert">Por favor espere, mientras se procesa...</span>
                <div id="progressBar" class="default"><div></div></div>
        	</div>
            </div>
  
        
        <table id="listSearch"   ></table> <div id="pagerSearch"></div>
    </div>
</body>
</html>

