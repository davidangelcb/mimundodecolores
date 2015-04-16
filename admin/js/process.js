    /* Nuevos envios por procesar*/   
    var afterSaveEditNews = function (xhr, postdata){
            var response = eval("(" + xhr.responseText + ")");
            alert(response.message);
            if (response.error == 1) {
                return false;
            }
            var current_index = $("#main").tabs("option","selected");
            $("#main").tabs('load',current_index);
            EDITACTIVE=false;
            return true;
    };  
    // $SQL = "select id, DATE_FORMAT(fecha,'%m-%d-%Y') as ingreso,apellidos, nombre, email,telefono,direccion,comentario
    function EnviosNews(){
            var consumerPriceCountryLastSel = null;
            jQuery("#list0").jqGrid({ 
                url:'ajax_news.php?oper1=listNews_', 
                datatype: "json", 
                multiselect: true,
                width: 800,
                colNames:['Ingreso','Apellidos', 'Nombre','Email', 'Telefono','Comentario'], 
                colModel:[ 
                    {name:'ingreso',index:'ingreso', width:60},
                    {name:'apellidos',index:'apellidos', width:150}, 
                    {name:'nombre',index:'nombre', width:140}, 
                    {name:'email',index:'email', width:135}, 
                    {name:'telefono',index:'telefono', width:65, align:"left",editable: true}, 
                    {name:'comentario',index:'mensaje_cliente', width:250,align:"left",editable: true}
                ],

                 editurl: "ajax_news.php?oper1=edit",   
                rowNum:50, 
                rowList:[50,100,150], 
                pager: '#pager0', 
                sortname: 'id', 
                viewrecords: true, 
                sortorder: "desc",
                gridComplete: checkaTodo,                               
                caption:"Lista de Mensajes enviados desde Formulario Contacto", 
                hidegrid: false, 
                height: 500 }); 
                $('#list0').trigger( 'reloadGrid' );
                //refrescaContadorPorProcesar();
                
    }        
    function refrescaContadorPorProcesar(){
            $.ajax({        
            url: 'ajax_search.php',        
            type: 'post',        
            data:{  
            oper1: 'maxNews'},        
            datetype: 'html',        
                success: function(data){     
                    $("#idTotalProcesados").val(data);
                }    
            });        
    }
    function checkaTodo(){
        return;
        var s; 
        var s = jQuery("#list0").getDataIDs();
        /**************/
            ab = $.trim(s);
            if(ab===''){
                return;
            }
            for(var i=0; i<s.length;i++){
                var nn= parseInt(s[i]); 
                if(nn>0){
                     jQuery("#list0").setSelection(nn);
                }
            }        
    }
    /*SELECT PROCESO 2*/    
    function EnviosProceso(){ 
            var consumerPriceCountryLastSel = null;
            jQuery("#list1").jqGrid({ 
                url:'ajax_procesando.php?oper1=listPro_', 
                datatype: "json", 
                width: 800,
                colNames:['Proceso','Apellidos', 'Nombre','Email', 'Telefono','Comentario'], 
                colModel:[ 
                    {name:'ingreso',index:'ingreso', width:60},
                    {name:'apellidos',index:'apellidos', width:150}, 
                    {name:'nombre',index:'nombre', width:140}, 
                    {name:'email',index:'email', width:135}, 
                    {name:'telefono',index:'telefono', width:65, align:"left",editable: true}, 
                    {name:'comentario',index:'mensaje_cliente', width:250,align:"left",editable: true}
                ],
                 editurl: "ajax_procesando.php?oper1=edit",   
                rowNum:50, 
                multiselect: false,
                rowList:[50,100,150], 
                pager: '#pager1', 
                sortname: 'id', 
                viewrecords: true, 
                sortorder: "desc", 
                caption:"Lista de Mensajes de contacto Arhivados", 
                hidegrid: false,
                
                height: 500 }); 
        $('#list1').trigger( 'reloadGrid' );
    }
    /*SELECT PROCESO 3*/    
    function EnviosRechazados(){
            var consumerPriceCountryLastSel = null;
            jQuery("#list2").jqGrid({ 
                url:'ajax_rechazados.php?oper1=listRecha_', 
                datatype: "json", 
                multiselect: true,
                width: 800,
                colNames:['','# Giro', 'Cliente','Fecha Ingreso', 'Celular','Mensaje'], 
                colModel:[ 
                    {name:'myedit', width:30, fixed:true, sortable:false, resize:false, formatter:'actions', formatoptions:{keys:true, editbutton:true, editformbutton: true, delbutton: false,editOptions: {
                        closeOnEscape: true,
                        closeAfterAdd: true,
                        viewPagerButtons: false,
                        closeAfterEdit: true,
                        reloadAfterSubmit: true,
                        afterSubmit: afterSaveEditNews
                    }}},                    
                    {name:'numero_giro',index:'numero_giro', width:60}, 
                    {name:'nombre_cliente',index:'nombre_cliente', width:180}, 
                    {name:'respuesta_api',index:'respuesta_api', width:140, align:"left"}, 
                    {name:'celular_cliente',index:'celular_cliente', width:70, align:"left",editable: true}, 
                    {name:'mensaje_cliente',index:'mensaje_cliente', width:350,align:"left",editable: true}
                ],
                editurl: "ajax_rechazados.php?oper1=edit",   
                rowNum:50, 
                rowList:[50,100,150], 
                pager: '#pager2', 
                sortname: 'id', 
                viewrecords: true, 
                sortorder: "desc", 
                caption:"Lista de Clientes por Procesar (seleccione para poder enviar SMS)", 
                hidegrid: false, 
                gridComplete: checkaTodo2,
                height: 500 }); 
                $('#list2').trigger( 'reloadGrid' );
    } 
    function checkaTodo2(){
        var s; 
        var s = jQuery("#list2").getDataIDs();
        /**************/
            ab = $.trim(s);
            if(ab===''){
                return;
            }
            for(var i=0; i<s.length;i++){
                var nn= parseInt(s[i]); 
                if(nn>0){
                     jQuery("#list2").setSelection(nn);
                }
            }        
    }    
    /*SELECT PROCESO 4
     $response->rows[$i]['cell']=array($row['numero_giro'],$row['nombre_cliente'],$row['celular_cliente'],$row['fecha_ingreso'],$row['fecha_proceso'],$row['id_sms']); 
     * */ 
    function EnviosEntregados(){
            var consumerPriceCountryLastSel = null;
            jQuery("#list3").jqGrid({ 
                url:'ajax_entregados.php?oper1=listPro_', 
                datatype: "json", 
                width: 800,
                colNames:['','# Dias','# Giro', 'Cliente', 'Telefono','Mensaje Cliente','Fecha Proceso','Estado','#Envios'], 
                colModel:[ 
                    {name:'myedit', width:30, fixed:true, sortable:false, resize:false, formatter:'actions', formatoptions:{keys:true, editbutton:true, editformbutton: true, delbutton: false,editOptions: {
                        closeOnEscape: true,
                        closeAfterAdd: true,
                        viewPagerButtons: false,
                        closeAfterEdit: true,
                        reloadAfterSubmit: true,
                        afterSubmit: afterSaveEditNews
                    }}},
                    {name:'dias',index:'dias', width:50}, 
                    {name:'numero_giro',index:'numero_giro', width:100}, 
                    {name:'nombre_cliente',index:'nombre_cliente', width:140}, 
                    {name:'celular_cliente',index:'celular_cliente', width:60, align:"left",  editable: true}, 
                    {name:'mensaje_cliente',index:'mensaje_cliente', width:200,  editable: true},
                    {name:'fecha_proceso',index:'fecha_proceso', width:120,align:"left",editable: false}, 
                    {name:'id_sms',index:'id_sms', width:60,  editable: false} ,
                    {name:'numero_envios',index:'numero_envios', width:60,  editable: false}                      
                ],
                 editurl: "ajax_entregados.php?oper1=edit",   
                rowNum:50, 
                multiselect: true,
                rowList:[50,100,150], 
                pager: '#pager3', 
                sortname: 'dias', 
                viewrecords: true,
                sortorder: "desc", 
                caption:"Lista Clientes en Proceso (Seleccione para  'Reenviar SMS')", 
                hidegrid: false,
                
                height: 500 }); 
        $('#list3').trigger( 'reloadGrid' );
    }
     
    /* Nuevos envios por procesar*/    
    function EnviosPendientes(){
            var consumerPriceCountryLastSel = null;
            jQuery("#list4").jqGrid({ 
                url:'ajax_pendiente.php?oper1=listPen_', 
                datatype: "json", 
                multiselect: true,
                width: 800,
                colNames:['','# Giro', 'Cliente','Estatus', 'Celular','Mensaje'], 
                colModel:[ 
                    {name:'myedit', width:30, fixed:true, sortable:false, resize:false, formatter:'actions', formatoptions:{keys:true, editbutton:true, editformbutton: true, delbutton: false,editOptions: {
                        closeOnEscape: true,
                        closeAfterAdd: true,
                        viewPagerButtons: false,
                        closeAfterEdit: true,
                        reloadAfterSubmit: true,
                        afterSubmit: afterSaveEditNews
                    }}},
                    {name:'numero_giro',index:'numero_giro', width:60}, 
                    {name:'nombre_cliente',index:'nombre_cliente', width:180}, 
                    {name:'respuesta_api',index:'respuesta_api', width:140, align:"left"}, 
                    {name:'celular_cliente',index:'celular_cliente', width:70, align:"left",editable: true}, 
                    {name:'mensaje_cliente',index:'mensaje_cliente', width:350,align:"left",editable: true}
                ],
                 editurl: "ajax_pendiente.php?oper1=edit",   
                rowNum:50, 
                rowList:[50,100,150], 
                pager: '#pager4', 
                sortname: 'id', 
                viewrecords: true, 
                sortorder: "desc", 
                caption:"Lista de Clientes Pendientes (seleccione para poder enviar a 'Por Procesar')", 
                hidegrid: false, 
                height: 500 });
                $('#list4').trigger( 'reloadGrid' );
                refrescaContadorPendientes();
    }   
    function refrescaContadorPendientes(){
            $.ajax({        
            url: 'ajax_search.php',        
            type: 'post',        
            data:{  
            oper1: 'maxPendientes'},        
            datetype: 'html',        
                success: function(data){     
                    $("#idTotalPendientes").val(data);
                }    
            });        
    }
    /*area reportes*/
    function buscarTemp(n){
        if(n==1){
            $("#buscar_2").hide("fast");
            $("#buscar_1").show("slow");
        }else{
            $("#buscar_1").hide("fast");
            $("#buscar_2").show("slow");
        }
    }