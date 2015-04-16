/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function addItemGaleria(){
    controlForm('');
}
function addItemAmbientes(){
    controlForm('');
}
function makeUpload(obj) {
    if(obj.value != "")
        obj.form.submit();
    obj.form.reset();
}
function clearViewGalery(){
     $('#frm_8_logo').val("");
     $('#frm_img_logo').val("");
     $('#bb_url_logo').val("");//titulo
     $('#bb_url_launcher_logo').val("");//contenido7
     $('#previewImg').html("");
     $('#idPartner').val("");
}
function controlFormClose(){
    $('#backClose').hide();
    $('#formItem').hide();
}
function controlForm(model){
    if(model==''){
            $('#backClose').show();
            $('#formItem').show();
            $('#idPartner').val("");
            $('#tituloForm').html("Agregar nuevo Item:<br><br><br>");
    }else{
          //loadItem  id
          //$('#tituloForm').html("Editar Item:<br><br><br>");
          
          $.ajax({        
            url: 'ajax_galeria.php',       
            type: 'post',        
            data:{  
            oper1: 'loadItem',
            id: model},        
            datetype: 'html',        
                success: function(data){     
                    if(data==="ERROR"){                
                        alert('Error DB, Ingreso intentelo luego.');
                    }else {
                        var datos = data.split("[||]");
                        var img = '<img height="65" src="../galeria/'+datos[2]+'"/>';
                        $('#backClose').show();
                        $('#formItem').show();
                        $('#tituloForm').html("Editar Item:<br><br><br>");
                        $('#idPartner').val(model);
                        $('#frm_8_logo').val("");
                        $('#frm_img_logo').val(datos[2]);
                        $('#bb_url_logo').val(datos[0]);//titulo
                        $('#bb_url_launcher_logo').val(datos[1]);//contenido7
                        $('#previewImg').html(img);
                    }        
                }    
            });
    }
}
function editRowGalery(id){
    controlForm(id);
}
function saveGaleria(){
  var dat_8=$('#frm_8_logo').val();
  var dat_9=$('#frm_img_logo').val();

  var idp=$('#idPartner').val();

  var op_1=$('#bb_url_logo').val();//titulo
  var op_2=$('#bb_url_launcher_logo').val();//contenido
  
  if(op_1==""){
	  alert("Por favor ingrese titulo");
	return;
  }
  if(op_2==""){
	  alert("Por favor ingrese una descripcion!");
	return;
  }
  if(dat_8=="" && dat_9==""){
	  alert("Imagen Requerida!");
	return;
  }
  
    $.ajax({        
            url: 'ajax_galeria.php',       
            type: 'post',        
            data:{  
            oper1: 'saveEdit',model:MODULOACT,
            ids: idp, op_1: op_1,op_2: op_2,dat_8: dat_8,dat_9:dat_9},        
            datetype: 'html',        
                success: function(data){     
                    if(data==="OK"){                
                        alert('Se grabo con Exito!');
                        clearViewGalery();
                        controlFormClose();
                        getItemsGalery();
                        //load new items
                    }else {
                        console.log(data);      
                    }        
                }    
            });  
}
function setEstado(estado,id){
    $.ajax({        
            url: 'ajax_galeria.php',       
            type: 'post',        
            data:{  
            oper1: 'EditStatus',
            id: id, estado:estado},        
            datetype: 'html',        
                success: function(data){     
                    if(estado=='X'){
                        if(data=='OK'){
                            alert("Se elimino con exito el registro!");
                            getItemsGalery();
                        }
                    }
                }    
            });
}
function deleteRowGalery(id){
    if (confirm('Seguro de eliminar el item?')) { 
        setEstado('X',id);
    }
}        
//1=activo  2=desactivo   b3_
function SendEstatus(model,idDiv){
    var estado = "";
    var html = "";
    if(model==1){
        estado='E';
        html = '<img src="media/act.jpg" border="0" height="18" width="18" title="[Desactivar]" onclick="SendEstatus(2,'+idDiv+')" class="mano"/>'; 
    }else{
        estado='D';
        html = '<img src="media/dea.gif" border="0" height="18" width="18" title="[Activar]" onclick="SendEstatus(1,'+idDiv+')" class="mano"/>';
    }
    setEstado(estado,idDiv);
    $('#b3_'+idDiv).html(html);
}

function saveGaleryC(){
    var chk0 = 'N';
    if(document.getElementById('actGalery2').checked==true){
         chk0 = 'Y';
    }
    var chk = 'N';
    if(document.getElementById('actGalery').checked==true){
         chk = 'Y';
    }
    var speedGalery = $('#speedGalery').val();
    if(speedGalery==''){
        alert("Ingrese Velocidad en la Galeria");
        return;
    }
        $.ajax({        
            url: 'ajax_galeria.php',       
            type: 'post',        
            data:{  
            oper1: 'ConfigGalery',
            speed: speedGalery, st:chk,st1:chk0},        
            datetype: 'html',        
                success: function(data){     
                        if(data=='OK'){
                            alert("Se actualizo!");
                        }
                }    
            });    
}
function saveNubeC(){
    var chk = 'N';
    if(document.getElementById('actNube').checked==true){
         chk = 'Y';
    }
    var speedGalery = $('#speedNube').val();
    if(speedGalery==''){
        alert("Ingrese Velocidad de Nube");
        return;
    }
        $.ajax({        
            url: 'ajax_galeria.php',       
            type: 'post',        
            data:{  
            oper1: 'ConfigNube',
            speed: speedGalery, st:chk},        
            datetype: 'html',        
                success: function(data){     
                        if(data=='OK'){
                            alert("Se actualizo!");
                        }
                }    
            });    
}
function savePassC(){
     
    var p1 = $('#pass1').val();
    var p2 = $('#pass1').val();
    if(p1=="" || p2==""){
        alert("Ingrese Password");
        return;
    }
    
    if(p1!=p2){
        alert("Ingrese Passwords identicos");
        return;
    }
        $.ajax({        
            url: 'ajax_galeria.php',       
            type: 'post',        
            data:{  
            oper1: 'ConfigPass',
            pass: p1},        
            datetype: 'html',        
                success: function(data){     
                        if(data=='OK'){
                            alert("Se actualizo!");
                        }
                }    
            });    
}
function saveCorreoC(){
    var p1 = $('#correo1').val();
    var p2 = $('#correo2').val();
    if(p1==""){
        alert("Ingrese Correo de contacto");
        return;
    }
     
        $.ajax({        
            url: 'ajax_galeria.php',       
            type: 'post',        
            data:{  
            oper1: 'ConfigEma',
            correo1: p1,correo2: p2},        
            datetype: 'html',        
                success: function(data){     
                        if(data=='OK'){
                            alert("Se actualizo!");
                        }
                }    
            });    
}