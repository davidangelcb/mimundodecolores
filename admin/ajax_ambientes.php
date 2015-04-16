<?php

require_once("lib/config.php");
require_once("lib/funcs.php");
/*
 * FUNCTIONS
 */
if (!sessionValid()) {
    echo "Error Session Lost, Please Login Again";
    exit;
}

function listNews($_GET)
{
        // verifica identidad en base de datos
        require_once("lib/load.php");
        $SQL = "select * from mimundo_galeria where estado!='X' and tipo='AMBIENTES' "; 
        $giros = DbArgenper::fetchAll($SQL);//fetchAll
        $html='<table cellspacing="0" cellpadding="0" border="0"  rules="groups" style="border:1px solid black;border-collapse: separate; ">
         <tr class="tituloGridth">
              <th width="180">Nombre</th>
              <th width="320">Descripcion</th>
              <th width="80">Imagen</th>
              <th width="200">Acciones</th>
         </tr>
         ';
         
        foreach($giros as $row){
        
            $img = '<img  height="30" src="../galeria/'.$row['imagenamenew'].'" border="0"/>';
            $iconE = '<div style="float:left;" id="b3_'.$row['id'].'"><img src="media/dea.gif" border="0" height="18" width="18" title="[Activar]" onclick="SendEstatus(1,'.$row['id'].')" class="mano"/></div>';
            if($row['estado']=='E'){
                $iconE = '<div style="float:left;" id="b3_'.$row['id'].'"><img src="media/act.jpg" border="0" height="18" width="18" title="[Desactivar]" onclick="SendEstatus(2,'.$row['id'].')" class="mano"/></div>';
            }
            
            $iconEditar = '<div style="float:left;"><img src="media/edi.png" border="0" title="[Editar]" height="18" class="mano" onclick="editRowGalery('.$row['id'].')" /> - </div>';
            $iconDelete  = '  <div style="float:left;"> - <img height="20" src="media/eli.png" border="0" title="[Eliminar]"  class="mano" onclick="deleteRowGalery('.$row['id'].')" />  </div>';
            $row['nombre'] = utf8_decode($row['nombre']);
            $row['descri'] = utf8_decode($row['descri']);
$html.= <<<STRSQL
<tr class="tituloGridtd" height="30">
              <td width="180">{$row['nombre']}</td>
              <td width="320"><div style="width:315px;">{$row['descri']}</div></td>
              <td width="80" height="30" align="center" style="text-align:30px;padding-top: 5px" >{$img}</td>
              <td width="200">{$iconEditar}   {$iconE}  {$iconDelete}</td>
</tr>
STRSQL;
        }

        return $html."</table>";
}

function edit($_POST){
        require_once("lib/load.php");
        $addq="";
        if ($_POST['dat_8'] != '') {
            //agregamos la imagen y borramos al otra
            //cambiamos de nombre
            $newname = md5unico() . strtolower(strrchr($_POST['dat_8'], "."));
            
            if (file_exists('temp/' . $_POST['dat_8']) && file_exists('temp/thumb_' . $_POST['dat_8'])) {
                
                if (copy( 'temp/' . $_POST['dat_8'], "../galeria/".$newname)) {
                    $addq = "imagename='".$_POST['dat_8']."', imagenamenew='" . $newname . "', ";
                    copy( 'temp/thumb_' . $_POST['dat_8'], "../galeria/thumb_".$newname);
                    
                    unlink('temp/' . trim($_POST['dat_8']));
                    unlink('temp/thumb_' . trim($_POST['dat_8']));
                }
            }
        }
        $datel = date("Y-m-d H:i:s");
        if(empty($_POST['ids'])){
            $query = "INSERT INTO mimundo_galeria (nombre,descri,date,imagename,imagenamenew,tipo) 
                values ('".utf8_encode($_POST['op_1'])."', '".utf8_encode($_POST['op_2'])."', '".$datel."', '".$_POST['dat_8']."', '".$newname."','AMBIENTES' )";
        }else{
            $query = "UPDATE mimundo_galeria SET nombre='".utf8_encode($_POST['op_1'])."', ".$addq." descri='".utf8_encode($_POST['op_2'])."' WHERE id='".$_POST['ids']."'";
        }
        DbArgenper::exec($query);
        return "OK";        
}

/*
 * HANDLER
 */
if (isset($_REQUEST["oper1"]) && !empty($_REQUEST["oper1"])) {
    if (!get_magic_quotes_gpc()) {
        foreach ($_REQUEST as $key => $value) {
            $_REQUEST[$key] = addslashes($value);
        }
    }
    switch ($_REQUEST["oper1"]) {
        case "ListItemsGalery" : echo listNews($_GET); break;
        case "saveEdit" : echo edit($_POST); break;
        case "procesa": echo procesa($_POST); break;
        case "EditStatus" : echo EditStatus($_POST); break;
        case "loadItem"   : echo loadItem($_POST); break;
        
        case "ConfigGalery" : echo ConfigGalery($_POST); break;
        case "ConfigNube" : echo ConfigNube($_POST); break;
        case "ConfigPass" : echo ConfigPass($_POST); break;
        case "ConfigEma" : echo ConfigEma($_POST); break;
    }
}

?>
