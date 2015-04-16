var logout = function() {
    document.location.href = "logout.php";
};
$(function() {
    //$( document ).tooltip();
});
var timeoutHnd;
function filtraCnt(){
	if(timeoutHnd) 
            clearTimeout(timeoutHnd);
        timeoutHnd = setTimeout(gridReload,500);    
}
function gridReload(){ 
    var cd_mask = jQuery("#numGiro").val(); 
    jQuery("#list1").jqGrid('setGridParam',{url:"ajax_procesando.php?oper1=listPro_&cd_mask="+cd_mask,page:1}).trigger("reloadGrid"); 
}
// buscar por NO FECHA
var timeoutHnd2;
function filtraCnt2(){
	if(timeoutHnd2) 
            clearTimeout(timeoutHnd2);
        timeoutHnd2 = setTimeout(gridReload2,500);    
}
function gridReload2(){ 
    var cd_mask = jQuery("#numGiro2").val(); 
    jQuery("#list3").jqGrid('setGridParam',{url:"ajax_entregados.php?oper1=listPro_&cd_mask="+cd_mask,page:1}).trigger("reloadGrid"); 
}
function grillaClear(){
    jQuery("#numGiro").val(""); 
    gridReload();
}
function grillaClear2(){
    jQuery("#numGiro2").val(""); 
    gridReload2();
}
var MODULOACT = 0;
var menuActive = function(modulo) {
    MODULOACT = modulo;
    $("#ControlMenu").hide("slow");

    $("#menuody_" + modulo).show("fast");
    if (modulo == 1) {
        
    }
    if(modulo==4){
        getItemsGalery();
    }
    if(modulo==3){
        getItemsGalery();
    }
    if(modulo==2){
        //loadTemplates();
        setTimeout("openSelectcontrol()", 1000);
    }
};
function setTemplate(t){
    var cnt = $("#input-empresa").val();
    var result = cnt.split("|||");
           
    if(result[0]==0){
        $("#input-mensaje").val("");
    }else{
        $("#input-mensaje").val(result[1]);
    }
}
function enviarPreview(){
    var num = $("#input-telefono").val();
    var nom = $("#input-nombre").val();
    var sms = $("#input-mensaje").val();
    //var cnt = $("#input-empresa").val();
    //var result = cnt.split("|||");
    sms=sms.replace("#{Nombre}#", nom);
    $("#Numfono").html(num);
    $("#SmsTexto").html(sms);
    $("#preview_").show();
}
var SMS_ = true;
function enviarSMS(){
    if(SMS_){
        var num = $("#input-telefono").val();
        var nom = $("#input-nombre").val();
        var sms = $("#input-mensaje").val();
        var cnt = $("#input-empresa").val();
        //var result = cnt.split("|||");
        if(num==''){
            alert("Ingrese un Numero Celular,gracias!");
            return;
        }
        if(sms==''){
            alert("Ingrese un Mensaje,gracias!");
            return;
        }
        sms=sms.replace("#{Nombre}#", nom);
        closePreview();
        SMS_ = false;
        $.ajax({        
            url: 'ajax_search.php',        
            type: 'post',        
            data:{  
            oper1: 'sendSMS',num: num,cnt: cnt,sms: sms,nom:nom},        
            datetype: 'html',        
                success: function(data){     
                    SMS_ = true;
                    if(data=="OK"){
                        clearSMS();
                        alert("Se envio su mensaje, con exito!");
                    }else{
                        alert(data);
                    }
                }    
            });
            
    }else{
        alert("Espere, el sistema esta procesando su peticion");
    }
}
function clearSMS(){
         $("#input-telefono").val("");
         $("#input-nombre").val("");
         $("#input-mensaje").val("");
         $("#input-empresa").val("0|||");    
}
function closePreview(){
    $("#Numfono").html("");
    $("#SmsTexto").html("");
    $("#preview_").hide();
}
function loadTemplates(){
        $.ajax({        
            url: 'ajax_search.php',        
            type: 'post',        
            data:{  
            oper1: 'loadTemplate'},        
            datetype: 'html',        
                success: function(data){     
                    $("#selectTemplate").html(data);
                }    
            });
}

function getItemsGalery(){

    $.ajax({        
            url: 'ajax_galeria.php',       
            type: 'post',        
            data:{  
            oper1: 'ListItemsGalery',model:MODULOACT},        
            datetype: 'html',        
                success: function(data){     
                        $("#cntItems"+MODULOACT).html(data);
                }    
            });
}
function addTemplate(){
	jQuery("#addgrid").jqGrid('editGridRow',"new",{height:280,reloadAfterSubmit:true,afterSubmit: afterSaveAdd,closeAfterAdd: true});
}
var afterSaveAdd = function (xhr, postdata){
            var response = eval("(" + xhr.responseText + ")");
            alert(response.message);
            return true;
};
var afterSaveEdit = function (xhr, postdata){
            var response = eval("(" + xhr.responseText + ")");
            alert(response.message);
            return true;
};
var afterDel = function (xhr, postdata){
            var response = eval("(" + xhr.responseText + ")");
            alert(response.message);
            $('#eData').click();
            return true;    
};
var EDITACTIVE = false;
function openEditAction(){
    EDITACTIVE=true;
}
//
function editTemplate(){
    var gr = jQuery("#addgrid").jqGrid('getGridParam','selrow'); 
    if( gr != null ) jQuery("#addgrid").jqGrid('editGridRow',gr,{height:280,reloadAfterSubmit:true,afterSubmit: afterSaveEdit}); else alert("Por favor seleccione un Item");    
}
function delTemplate(){
    var gr = jQuery("#addgrid").jqGrid('getGridParam','selrow'); if( gr != null ) jQuery("#addgrid").jqGrid('delGridRow',gr,{reloadAfterSubmit:true,afterSubmit: afterDel,closeAfterDel: true}); else alert("Por Favor Seleccione Item a Eliminar!");
}
function activeSearch(){
              jQuery("#listSearch").jqGrid({ datatype: "local", height: 250, width: 800,
                  colNames:['# Giro','Cliente', 'Fecha Ingreso', 'Celular','Estado','Mensaje'], 
                  colModel:[ 
                      {name:'id',index:'id', width:110 ,sortable:false}, 
                      {name:'invdate',index:'invdate', width:160,sortable:false},
                      {name:'name',index:'name', width:120, sorttype:"date",sortable:false}, 
                      {name:'amount',index:'amount', width:60, align:"right",sorttype:"int",sortable:false}, 
                      {name:'estado',index:'estado', width:100, sorttype:"date",sortable:false}, 
                      {name:'note',index:'note', width:250, sortable:false} ], 
                  multiselect: false, caption: "resultado de Filtros" });
                buscarTemp(1);
                $( "#datepicker" ).datepicker();
                $( "#datepicker2" ).datepicker();
                document.getElementById("defaulSearch").checked=true;
                setTimeout("loadDataInicial()",2000);
}

var TipoSearch = 1;
function loadDataInicial(){
        //clear data Temp
        var objArray5 = [];
        jQuery("#listSearch").clearGridData(true).trigger("reloadGrid").addRowData('id',objArray5);        
        
        /* var mydata = [ {id:"1",invdate:"David Camam Buleje",name:"2007-10-01",amount:"987987987",note:"Hpla como estas akaasdlkjasd"}, {id:"2",invdate:"David Camam Buleje",name:"2007-10-03",amount:"887987987",note:"Hpla como estas akaasdlkjasd"}]; 
        for(var i=0;i<=mydata.length;i++) jQuery("#listSearch").jqGrid('addRowData',i+1,mydata[i]);                */
        var tipo = 1;
        var fechaIni = "";
        var fechaFin = "";
        var dropMenu = 1;
        var columna=0;
        var criteria="";
        $.ajax({        
            url: 'ajax_search.php',        
            type: 'post',        
            data:{  
            oper1: 'searching', tipo: tipo,fechaIni: fechaIni,fechaFin: fechaFin,dropMenu: dropMenu,columna: columna,criteria: criteria},        
            datetype: 'json',        
                success: function(data){     
                    var mydata = eval(data); 
                    for(var i=0;i<=mydata.length;i++) jQuery("#listSearch").jqGrid('addRowData',i+1,mydata[i]);
                    
                    if(mydata.length>0){
                        $("#buscar_1_dw").show("slow");
                    }
                }    
            });
}
function buscarCriterio(n){
        //clear data Temp
        TipoSearch=n;
        var objArray5 = [];
        jQuery("#listSearch").clearGridData(true).trigger("reloadGrid").addRowData('id',objArray5);        
        
        var tipo = n;
        $("#buscar_"+tipo+"_msg").html("");
        var fechaIni = $("#datepicker").val();
        var fechaFin = $("#datepicker2").val();
        var dropMenu = $("#sel_1").val();
        var columna=$("#sel_2").val();
        var criteria=$("#criteria").val();
        $.ajax({        
            url: 'ajax_search.php',        
            type: 'post',        
            data:{  
            oper1: 'searching', tipo: tipo,fechaIni: fechaIni,fechaFin: fechaFin,dropMenu: dropMenu,columna: columna,criteria: criteria},        
            datetype: 'json',        
                success: function(data){     
                    var mydata = eval(data); 
                    for(var i=0;i<=mydata.length;i++) jQuery("#listSearch").jqGrid('addRowData',i+1,mydata[i]);
                    
                    if(mydata.length>0){
                        $("#buscar_"+tipo+"_dw").show("slow");
                        $("#buscar_"+tipo+"_msg").html("");
                    }else{
                        $("#buscar_"+tipo+"_dw").hide("fast");
                        $("#buscar_"+tipo+"_msg").html("<span class='nomatch'>No hay resultados.</span>");
                    }
                }    
            });
}
function  descargaCsv(n){
        var tipo = n;
        var fechaIni = $("#datepicker").val();
        var fechaFin = $("#datepicker2").val();
        var dropMenu = $("#sel_1").val();
        var columna=$("#sel_2").val();
        var criteria =$("#criteria").val();
        
        bodycsv.location.href="csv_downloads.php?fechaIni="+fechaIni+"&fechaFin="+fechaFin+"&dropMenu="+dropMenu+"&columna="+columna+"&criteria="+criteria+"&tipo="+tipo;
} 
function refrescaGrilla(){
    switch(SelectAct){
        case 1: $('#list0').trigger( 'reloadGrid' );break;
        case 2: $('#list1').trigger( 'reloadGrid' ); break;
        case 3: $('#list2').trigger( 'reloadGrid' ); break;
        case 4: $('#list3').trigger( 'reloadGrid' ); break;
        case 5: $('#list4').trigger( 'reloadGrid' ); break;
    }
}
function openSelectcontrol() {
    $("#selectControl").show("fast");
    EnviosNews();  // primero OFicina
    if(SelectAct==1){
        windowProcessAuto=1;
    }
    if(SelectAct==2){
        EnviosProceso();// PROCESADO CON FECHA
    }
    if(SelectAct==3){
        EnviosRechazados();
    }
    if(SelectAct==4){
        EnviosEntregados();// sin Fecha
    }
    if(SelectAct==5){
        EnviosPendientes();
        windowPendientes=1;
    }
}
var closeModulo = function(modulo) {
    $("#menuody_" + modulo).hide("fast");
    $("#ControlMenu").show();
    windowProcessAuto=0;
    windowPendientes=0;
};
var windowProcessAuto = 0;
var windowPendientes = 0;
var SelectAct = 1;
$(function() {
    $(".select-group li.select-box").html($(".select-group li.select-selected").text() + "<div class='icon-select'></div>");
    $("#select-value").text($(".select-group li.select-selected").attr("value"));

    $(".select-group li").bind("click", function() {
        $('li').toggle();

        $(".select-group li.select-box").show();
        $(".select-group li.select-box").html($(this).text() + "<div class='icon-select'></div>");
        $("#select-value").text($(this).attr("value"));
        if (SelectAct != $(this).attr("value")) {
            SetProcess($(this).attr("value"));
        }
        if($(this).attr("value")==1){
            windowProcessAuto= 1;
        }else{
            windowProcessAuto=0;
        }
        if($(this).attr("value")==5){
            windowPendientes= 1;
        }else{
            windowPendientes=0;
        }
        SelectAct = $(this).attr("value");
    });
});
var procesaBtn_ = function() {
    var s;
    s = jQuery("#country_currecny").jqGrid('getGridParam', 'selarrrow');
    alert("Numero de elementos seleccionados: " + s.length);
};
var GripActive = 1;
function SetProcess(n) {
    if(n==GripActive){
        $("#win_" + GripActive).show("fast");
    }else{
        $("#win_" + GripActive).hide("fast");
        $("#win_" + n).show("fast");
    }
    $("#window_" + GripActive).hide("fast");
    GripActive = n;
    $("#window_" + n).show("fast");
    switch (n) {
        case 1:
            EnviosNews();
            break;
        case 2:
            EnviosProceso();
            break;
        case 3:
            EnviosRechazados();
            break;
        case  4:
            EnviosEntregados();
            break
        case  5:
            EnviosPendientes();
            break            
    }
}
;
function myTrim(x)
{
    return x.replace(/^\s+|\s+$/gm,'');
}
var ActiProcesando = true;
function EnviarPorProcesar() {
    
if(ActiProcesando){    
            var s; 
            s = jQuery("#list4").jqGrid('getGridParam','selarrrow');
            ab = $.trim(s);
            if(ab===''){
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
            muestraAlertas(0,5);
            ActiProcesando=false;
             $.ajax({        
                url: 'ajax_pendiente.php',        type: 'post',        
                data:{  
                oper1: 'procesa',    ids: ids},        
                datetype: 'html',        
                    success: function(data){     
                        ActiProcesando=true;
                        if(data==="Done"){                
                            progressBar(100, $('#progressBar5'));
                            $('#msgAlert5').html("<b style='color:green;'>Se proceso Todos los pedidos</b>");

                            setTimeout("close5()",2000);
                            //
                        } 
                        else {
                            muestraAlertas(1,5);
                            alert('Error en el proceso, Intente luego!');            
                        }        
                    }    
                });
    }else{
     alert("Espere se esta ejecutando un proceso!");
    }                
}
function Reenviar() {

            var s; 
            s = jQuery("#list1").jqGrid('getGridParam','selarrrow');
            ab = $.trim(s);
            if(ab===''){
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
            muestraAlertas(0,2);
             $.ajax({        
                url: 'ajax_procesando.php',        type: 'post',        
                data:{  
                oper1: 'procesa',    ids: ids},        
                datetype: 'html',        
                    success: function(data){     
                        var datax = data.split('||');
                        if(datax[0]==="Done"){
                            $('#contadorActivo').html('<span style="color:white;">Procesados('+datax[1]+')</span>');
                            progressBar(100, $('#progressBar2'));
                            $('#msgAlert2').html("<b style='color:green;'>Se proceso Todos los pedidos</b>");

                            setTimeout("close2()",2000);
                            //
                        } 
                        else {
                            muestraAlertas(1,2);
                            alert('Error en el proceso, Intente luego!');            
                        }        
                    }    
                });
}
function ReenviarFecha() {

            var s; 
            s = jQuery("#list3").jqGrid('getGridParam','selarrrow');
            ab = $.trim(s);
            if(ab===''){
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
            muestraAlertas(0,4);
             $.ajax({        
                url: 'ajax_entregados.php',        type: 'post',        
                data:{  
                oper1: 'procesa',    ids: ids},        
                datetype: 'html',        
                    success: function(data){     
                        var datax = data.split('||');
                        if(datax[0]==="Done"){                
                            progressBar(100, $('#progressBar4'));
                            $('#contadorActivo').html('<span style="color:white;">Procesados('+datax[1]+')</span>');
                            $('#msgAlert4').html("<b style='color:green;'>Se proceso Todos los pedidos</b>");

                            setTimeout("close4()",2000);
                            //
                        } 
                        else {
                            muestraAlertas(1,4);
                            alert('Error en el proceso, Intente luego!');            
                        }        
                    }    
                });
}
function PorProcesar() {

            var s; 
            s = jQuery("#list0").jqGrid('getGridParam','selarrrow');
            ab = $.trim(s);
            if(ab===''){
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
            muestraAlertas(0,1);
             $.ajax({        
                url: 'ajax_news.php',        type: 'post',        
                data:{  
                oper1: 'procesa',    ids: ids},        
                datetype: 'html',        
                    success: function(data){     
                        var datax = data.split('||');
                        if(datax[0]==="Done"){                
                            
                            progressBar(100, $('#progressBar1'));
                            $('#msgAlert1').html("<b style='color:green;'>Se proceso Todos los pedidos</b>");

                            setTimeout("close1()",2000);
                            //
                        } 
                        else {
                            muestraAlertas(1,1);
                            alert('Error en el proceso, Intente luego!');            
                        }        
                    }    
                });
}
function PorProcesarDepositos() {

            var s; 
            s = jQuery("#list2").jqGrid('getGridParam','selarrrow');
            ab = $.trim(s);
            if(ab===''){
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
            muestraAlertas(0,3);
             $.ajax({        
                url: 'ajax_rechazados.php',        type: 'post',        
                data:{  
                oper1: 'procesa',    ids: ids},        
                datetype: 'html',        
                    success: function(data){     
                        var datax = data.split('||');
                        if(datax[0]==="Done"){                
                            
                            progressBar(100, $('#progressBar3'));
                            $('#msgAlert3').html("<b style='color:green;'>Se proceso Todos los pedidos</b>");

                            setTimeout("close3()",2000);
                            //
                        } 
                        else {
                            muestraAlertas(1,3);
                            alert('Error en el proceso, Intente luego!');            
                        }        
                    }    
                });
}
function close5(){    
    muestraAlertas(1,5);
    $('#list4').trigger( 'reloadGrid' );
}
function close1(){     
    muestraAlertas(1,1);
    $('#list0').trigger( 'reloadGrid' );
}
function close2(){    
    muestraAlertas(1,2);
    $('#list1').trigger( 'reloadGrid' );
}
function close3(){    
    muestraAlertas(1,3);
    $('#list2').trigger( 'reloadGrid' );
}
function close4(){    
    muestraAlertas(1,4);
    $('#list3').trigger( 'reloadGrid' );
}
function muestraAlertas(opt,id){
        if(opt===1){
            $("#bloqueo"+id).hide();
            progressBar(0, $('#progressBar'+id));
        }else{
            $("#bloqueo"+id).show();
            progressBar(20, $('#progressBar'+id));
        }
}