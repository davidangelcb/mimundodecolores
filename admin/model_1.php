<?php
$query0 = "select *  from configuracion   limit 1";
$_conf = DbArgenper::fetchOne($query0);//
$ch0 = "";
$ch1 = "";
$ch2 = "";
if($_conf){
    $config['galerySpeed'] =$_conf['galeryTiempo']; 
    $config['galeryComentarios'] =$_conf['galeryComentario']; 
    $config['ambienteComentarios'] =$_conf['ambienteComentario']; 
    $config['nubeSpeed'] =$_conf['animacionnubetiempo']; 
    $config['nube'] =$_conf['animacionnube']; 
    
    $config['correo'] =$_conf['correocontacto']; 
    $config['correocc'] =$_conf['correocccontacto'];
    
    if($config['ambienteComentarios']=="Y"){
        $ch0 = 'checked="true"';
    }
    if($config['galeryComentarios']=="Y"){
        $ch1 = 'checked="true"';
    }
    if($config['nube']=="Y"){
        $ch2 = 'checked="true"';
    }
}

?>
            <div class="tituloModulo">CONFIGURACION DE ENTORNO</div>
                    <div class="closeModulo" onclick="closeModulo(1)">[ close window ] &nbsp;&nbsp;</div>
                    <br><br>
                    
                                            
                    
                    <div style="float: left; height: 170px; width: 700px; padding-left: 50px;">
                        <section style="margin: 10px;"></section>
                        <fieldset style="border-radius: 5px; padding: 5px; min-height:120px;border:4px solid #1F497D;">
                        <legend><b> Galeria - </b> </legend>
                        <table>
                            <tr>
                                <td class="txtOpt" width="250">Activar Titulo y Descripcion: </td>
                                <td><input class="txtOpt" type="checkbox" <?php echo $ch1;?>  id="actGalery"/> <span class="info">(i) Activa o no en Galeria Web</span></td>
                            </tr>
                            <tr>
                                <td class="txtOpt" width="250">Activar Titulo y Descripcion: </td>
                                <td><input class="txtOpt" type="checkbox" <?php echo $ch0;?>  id="actGalery2"/> <span class="info">(i) Activa o no en Ambientes Web</span></td>
                            </tr>
                            <tr>
                                <td class="txtOpt" >Velocidad entre Slide: </td>
                                <td>&nbsp;<input class="txtOpt" type="text" value="<?php echo $config['galerySpeed'];?>" id="speedGalery" style="width:60px "/> <span class="info">(i) ingresar  segundos [1, 2, etc]</span></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="txtOpt" style="text-align: center;"><input onclick="saveGaleryC()" type="button" class="actualiza" value="Actualizar"></td>
                            </tr>
                        </table>
                        
                        </fieldset>
                    </div>
                    <div style="clear: both"></div>
                    <div style="float: left; height: 170px; width: 700px; padding-left: 50px;">
                        <section style="margin: 10px;"></section>
                        <fieldset style="border-radius: 5px; padding: 5px; min-height:120px;border:4px solid #1F497D;">
                        <legend><b> Nube - Paginas PHP</b> </legend>
                        <table>
                            <tr>
                                <td class="txtOpt" width="250">Activar Nube: </td>
                                <td><input class="txtOpt" <?php echo $ch2;?> type="checkbox" id="actNube"/> <span class="info">(i) Activa o no la Animacion</span></td>
                            </tr>
                            <tr>
                                <td class="txtOpt" >Velocidad de las Nubes: </td>
                                <td>&nbsp;<input class="txtOpt" value="<?php echo $config['nubeSpeed'];?>" type="text" id="speedNube" style="width:60px "/> <span class="info">(i) ingresar  rango[1(muy veloz)---100(muy lento)]</span></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="txtOpt" style="text-align: center;"><input type="button" onclick="saveNubeC()" class="actualiza mano" value="Actualizar"></td>
                            </tr>
                        </table>                        
                        </fieldset>
                    </div>
                    <div style="clear: both"></div>
                    <div style="float: left; height: 170px; width: 700px; padding-left: 50px;">
                        <section style="margin: 10px;"></section>
                        <fieldset style="border-radius: 5px; padding: 5px; min-height:120px;border:4px solid #1F497D;">
                        <legend><b> Formulario Contacto</b> </legend>
                        <table>
                            <tr>
                                <td class="txtOpt" width="250">Correo: </td>
                                <td>&nbsp;<input class="txtOpt" type="text" id="correo1" style="width:250px " value="<?php echo $config['correo'];?>"/> <span class="info">(i) Correo de envio</span></td>
                            </tr>
                            <tr>
                                <td class="txtOpt" >CC correo: </td>
                                <td>&nbsp;<input class="txtOpt" type="text" id="correo2" style="width:250px " value="<?php echo $config['correocc'];?>"/> <span class="info">(i) Copia de correo</span></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="txtOpt" style="text-align: center;"><input type="button" onclick="saveCorreoC()" class="actualiza mano" value="Actualizar"></td>
                            </tr>
                        </table>
                        </fieldset>
                    </div>
                    <div style="clear: both"></div>
                    <div style="float: left; height: 170px; width: 700px; padding-left: 50px;">
                        <section style="margin: 10px;"></section>
                        <fieldset style="border-radius: 5px; padding: 5px; min-height:120px;border:4px solid #1F497D;">
                        <legend><b> Accesos</b> </legend>
                        <table>
                            <tr>
                                <td class="txtOpt" width="250">Ingrese Nuevo Pass: </td>
                                <td>&nbsp;<input class="txtOpt" type="password" id="pass1" style="width:60px "/> <span class="info">(i) identico al sgte</span></td>
                            </tr>
                            <tr>
                                <td class="txtOpt" >Repita el Nuevo Pass: </td>
                                <td>&nbsp;<input class="txtOpt" type="password" id="pass2" style="width:60px "/> <span class="info">(i) No olvide el password</span></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="txtOpt" style="text-align: center;"><input type="button" onclick="savePassC()" class="actualiza mano" value="Actualizar"></td>
                            </tr>
                        </table>
                        </fieldset>
                    </div>
                    <div style="clear: both"></div>
                    
                     