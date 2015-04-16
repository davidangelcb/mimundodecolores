
<style type="text/css">
    .spacer{
        height: 15px
    }
</style>
<table width="72%" cellpadding="0" cellspacing="7" align='center'  border="0" align="left" style="margin-left: 105px; margin-top: 15px;">
    <tr>
        <td>
            <div class="lblProfilet" style="color: #003366" id="tituloForm">
                Agregar nuevo Item:<br><br><br>
            </div>
        </td>
    </tr>

    <tr>
        <td valign="top"><div class="lblProfilet" style="color: #003366">
                <table cellpadding="0" cellspacing="0" border="0" align="left">
                    <tr><td>Titulo</td>
                        <td>&nbsp;</td>
                        <td ></td>
                    </tr>
                </table>
            </div><input type="hidden" id="idPartner" value="" /></td>
    </tr>
    <tr><td align="left"><input type="text" class="txtProfile"id="bb_url_logo" value="" style="width: 250px;"/><br><br><br></td></tr>
    <tr>
        <td valign="top"><div class="lblProfilet" style="color: #003366">
                <table cellpadding="0" cellspacing="0" border="0" align="left">
                    <tr><td>Descripcion</td>
                        <td>&nbsp;</td>
                        <td ></td>
                    </tr>
                </table>
            </div></td>
    </tr>
    <tr><td align="left"><textarea   class="txtProfile" id="bb_url_launcher_logo" value="" style="width: 250px; height: 50px;"/></textarea><br><br><br></tr>
    <tr>
        <td align="left"><div class="lblProfilet" style="width:200px; color: #003366">
            <table cellpadding="0" cellspacing="0" border="0" align="left">
                <tr><td>Selecciona Imagen</td>
                    <td>&nbsp;</td>
                    <td ></td>
                </tr>
            </table>

            </div></td>
    </tr>
    <tr><td align="left"><div style="position:relative; z-index:12; display:block;" id="imgDiv">
                <div style="position:absolute;top:0px;left:108px;z-index:13; width:100px;  overflow:hidden;">
                    <form method="post" enctype="multipart/form-data" target="uploadHandler" action="upload_galery.php">
                        <input type="File" onChange="makeUpload(this);" style="width:118px; -moz-opacity:0;   filter:alpha(opacity:0);   opacity: 0; cursor:pointer;" name="upload" id="uploadImgN" />
                    </form>
                </div><input type="text" readonly="readonly" style="width:100px;" class="txtProfile" id="frm_8_logo" value=""/><input type="button" class="txtProfile" style="width:75px;" value="Upload" />
                <input type="hidden" id="frm_img_logo" value=""/>
            </div>
        </td></tr>
    <tr><td align="left"><div id="previewImg" class="imgViewer"></div></td></tr>
    <tr>
        <td align="left" class="vendor_subtitle_linkNb"><br><br><b><font class="vendor_subtitle">[</font><span style="text-decoration:none; font-family:arial; font-size:14px;color:#01cc33; font-weight:bold;" onclick="saveGaleria()"> Grabar Item </span><font class="vendor_subtitle">]</font></b>
        <b><font class="vendor_subtitle">[</font><span style="text-decoration:none; font-family:arial; font-size:14px;color:#01cc33; font-weight:bold;" onclick="clearViewGalery();controlFormClose();"> Cerrar </span><font class="vendor_subtitle">]</font></b>
        </td>
    </tr>
</table>