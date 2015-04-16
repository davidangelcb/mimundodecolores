<script type="text/javascript">
    $(function () {
        var cache = {};
        var partnerIds = {};
        var couponLastSel = null;
        
        var afterSaveEdit = function (xhr, postdata){
            var response = eval("(" + xhr.responseText + ")");
            alert(response.message);
            if (response.error == 1) {
                return false;
            }
            var current_index = $("#main").tabs("option","selected");
            $("#main").tabs('load',current_index);
            return true;
        };
        
        var pickdates = function(id) { 
            jQuery("#" + id + "_dateini", "#coupons").datepicker({dateFormat:"yy-mm-dd"}); 
            jQuery("#" + id + "_dateend", "#coupons").datepicker({dateFormat:"yy-mm-dd"});
            
            $("#" + id + "_partner", "#coupons").autocomplete({
                minLength: 2,
                source: function(request, response) {
                    var term = request.term;
                    if ( term in cache ) {
                        response( cache[ term ] );
                        return;
                    }
                    request.oper = "search";
                    
                    $.getJSON("https://tools.bongous.com/api/partner.php", request, function( data, status, xhr ) {
                        cache[ term ] = data;
                        response( data );
                    });
                },
                select: function (event, ui) {
                    partnerIds[id] = ui.item.id;
                }
            });
        }
        
        jQuery("#coupons").jqGrid({
            datatype: "local",
            height: "auto",
            width: 990,
            colNames:[' ', ' ', 'Code', 'Type', 'Partner', 'Amount', 'Percentage', 'Date Ini', 'Date Fin', 'State'],
            colModel:[
                {name:'myedit', width:30, fixed:true, sortable:false, resize:false, formatter:'actions', formatoptions:{keys:true, editbutton:true, editformbutton: true, delbutton: false,editOptions: {
                        closeOnEscape: true,
                        closeAfterAdd: true,
                        viewPagerButtons: false,
                        closeAfterEdit: true,
                        reloadAfterSubmit: true,
                        afterSubmit: afterSaveEdit
                    }}},
                {name:'myac', width:30, fixed:true, sortable:false, resize:false, formatter:'actions', formatoptions:{keys:true, editbutton:false, delOptions: {closeOnEscape: true, afterSubmit: function (j, req) {
                    $('#eData').click();
                    jQuery("#coupons").delRowData(req.id);
                }}}},
                {name:'code',index:'code', editable: true, editrules:{required:true}},
                {name:'type',index:'type', editable: true, edittype:"select",formatter:'select',editoptions:{value:"E:EXTEND"}},
                {name:'partner',index:'partner', editable: true, required: true},
                {name:'amount',index:'amount', editable: true, editrules:{number:true, minValue:0}},
                {name:'percentage',index:'percentage', editable: true, editrules:{number:true,minValue:0}},
                {name:'dateini',index:'dateini', editable: true, sorttype:"date", editrules:{required:true, date: true}, formatter: 'date',
                    formatoptions: {
                        srcformat: 'ISO8601Long',
                        newformat: 'Y-m-d',
                        defaultValue:null
                    },edittype: 'text',
                    editoptions: {
                        size: 12,
                        maxlengh: 12,
                        dataInit: function (element) {
                            $(element).datepicker({ dateFormat: 'yy-mm-dd' });
                        }
                    }},
                {name:'dateend',index:'dateend', editable: true, sorttype:"date", editrules:{required:true, date: true}, formatter: 'date',
                    formatoptions: {
                        srcformat: 'ISO8601Long',
                        newformat: 'Y-m-d',
                        defaultValue:null
                    },edittype: 'text',
                    editoptions: {
                        size: 12,
                        maxlengh: 12,
                        dataInit: function (element) {
                            $(element).datepicker({ dateFormat: 'yy-mm-dd' });
                        }
                    }},
                {name:'state',index:'state', editable: true, edittype:"select",formatter:'select',editoptions:{value:"A:Activo;I:Inactivo;U:Usado"}}
            ],
            rowNum: 1000,
            editurl: "https://tools.bongous.com/pay_admin_coupon.php",
            caption: "Coupon List"
        });

        var data = [{"id":"30","code":"5FEB14","type":"E","partner":"ALL","amount":"5","percentage":"0","dateini":"2014-01-31","dateend":"2014-02-28","state":"A","idpartner":"0"},{"id":"29","code":"INVFEB","type":"E","partner":"ALL","amount":"0","percentage":"10","dateini":"2014-01-31","dateend":"2014-02-28","state":"A","idpartner":"0"},{"id":"28","code":"MOVE50","type":"E","partner":"ALL","amount":"0","percentage":"50","dateini":"2014-01-30","dateend":"2014-01-31","state":"I","idpartner":"0"},{"id":"27","code":"JAN14","type":"E","partner":"ALL","amount":"5","percentage":"0","dateini":"2014-01-07","dateend":"2014-01-31","state":"I","idpartner":"0"},{"id":"26","code":"INVJAN","type":"E","partner":"ALL","amount":"0","percentage":"10","dateini":"2014-01-07","dateend":"2014-01-31","state":"I","idpartner":"0"},{"id":"25","code":"188576","type":"E","partner":"ALL","amount":"0","percentage":"5","dateini":"2013-12-20","dateend":"2013-12-22","state":"I","idpartner":"0"},{"id":"24","code":"JAMES1","type":"E","partner":"ALL","amount":"0","percentage":"100","dateini":"2013-11-22","dateend":"2013-11-25","state":"I","idpartner":"0"},{"id":"22","code":"Nov13","type":"E","partner":"ALL","amount":"5","percentage":"0","dateini":"2013-11-21","dateend":"2013-11-30","state":"I","idpartner":"0"},{"id":"19","code":"INVNT","type":"E","partner":"ALL","amount":"0","percentage":"10","dateini":"2013-11-04","dateend":"2013-12-31","state":"I","idpartner":"0"},{"id":"18","code":"FIRST1","type":"E","partner":"ALL","amount":"5","percentage":"0","dateini":"2013-11-04","dateend":"2013-12-31","state":"I","idpartner":"0"},{"id":"17","code":"INVN3","type":"E","partner":"ALL","amount":"0","percentage":"10","dateini":"2013-09-19","dateend":"2013-10-31","state":"I","idpartner":"0"},{"id":"16","code":"BONGO5","type":"E","partner":"ALL","amount":"5","percentage":"0","dateini":"2013-06-28","dateend":"2013-12-31","state":"I","idpartner":"0"},{"id":"14","code":"152690UK","type":"E","partner":"ALL","amount":"0","percentage":"30","dateini":"2013-06-28","dateend":"2013-06-30","state":"I","idpartner":"0"},{"id":"13","code":"JORGE50","type":"E","partner":"ALL","amount":"0","percentage":"50","dateini":"2013-06-27","dateend":"2013-07-04","state":"I","idpartner":"0"},{"id":"12","code":"Jennean","type":"E","partner":"ALL","amount":"10","percentage":"0","dateini":"2013-05-07","dateend":"2013-05-30","state":"I","idpartner":"0"},{"id":"11","code":"CRAIGTEST","type":"E","partner":"ALL","amount":"0","percentage":"10","dateini":"2013-05-03","dateend":"2013-05-06","state":"I","idpartner":"0"},{"id":"10","code":"DFVDFVDFV","type":"E","partner":"ALL","amount":"16","percentage":"0","dateini":"2013-05-15","dateend":"2013-05-31","state":"I","idpartner":"0"},{"id":"9","code":"Q65A3SD4Q","type":"E","partner":"ALL","amount":"0","percentage":"14","dateini":"2013-05-07","dateend":"2013-05-24","state":"I","idpartner":"0"},{"id":"8","code":"DIADELAMADRE2013","type":"E","partner":"ALL","amount":"12","percentage":"0","dateini":"2013-05-08","dateend":"2013-05-24","state":"I","idpartner":"0"},{"id":"7","code":"AKS5S4Q5EA","type":"E","partner":"ALL","amount":"12","percentage":"0","dateini":"2013-05-08","dateend":"2013-05-25","state":"I","idpartner":"0"}];
        for (var i=0; i<data.length; i++) {
            jQuery("#coupons").jqGrid('addRowData', data[i].id, data[i]);
            partnerIds[i+1] = data[i].idpartner;
        }
        
        $("#addCoupon").button({
            icons: {
                primary: "ui-icon-plus"
            }
        });
        
        $("#addCoupon").click(function(){ 
            jQuery("#coupons").jqGrid('editGridRow', "new", {height:310, editData: {idpartner: function () { return partnerIds['new_row']}}, afterComplete: function (xhr) {
                var response = eval("(" + xhr.responseText + ")");
                if (response.error == 0) {
                    var current_index = $("#main").tabs("option","selected");
                    $("#main").tabs('load',current_index);
                    $('#cData').click();
                }
            },
            errorTextFormat:function(data){
                if (data.status == 400) {
                    return data.statusText;
                } else {
                    return 'ERROR';
                }    
            }}); 

            $("#partner", "#TblGrid_coupons").autocomplete({
                minLength: 2,
                source: function(request, response) {
                    var term = request.term;
                    if ( term in cache ) {
                        response( cache[ term ] );
                        return;
                    }
                    request.oper = "search";
                    
                    $.getJSON("https://tools.bongous.com/api/partner.php", request, function( data, status, xhr ) {
                        cache[ term ] = data;
                        response( data );
                    });
                },
                select: function (event, ui) {
                    partnerIds['new_row'] = ui.item.id;
                }
            });
        });
    });
</script>
<br />
<table id="editgrid" class="" ></table>
<button id="addCoupon">Add Coupon</button>
<br /><br />
<table id="coupons"></table>