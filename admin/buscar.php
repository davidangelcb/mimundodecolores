<div style="width: 100%;display: block;" id="buscar_1">
    <div style="float: left">
        <div class="styled-select">
            <select id="sel_1">
                <option value="1">Items Procesados</option>
                <option value="2">Items Por Procesar</option>
                <option value="5">Items Enviados</option>
                <option value="6">Items Fallidos</option>
                <option value="7">Items Pendientes (Api SMS)</option>
                <option value="3">Items Pendientes (por fecha de ingreso)</option>
                <option value="4">Todos (por fecha de ingreso)</option>
                <option value="8">Todos SMS enviados</option>
            </select>
        </div>
    </div>
    <div style="float: left; margin-left: 10px; height: 40px;">
        <span style="color:black; font-size: 12px;line-height: 40px;">Inicio: <input type="text" value="<?php echo date("Y-m-d"); ?>" id="datepicker" class="dateT"></span>
        <span style="color:black; font-size: 12px;line-height: 40px;">Fin: <input type="text"  value="<?php echo date("Y-m-d"); ?>" id="datepicker2" class="dateT"></span>
    </div>
    <div style="float: left; margin-left: 10px; height: 40px;">
        <a href="javascript:buscarCriterio(1)" class="classname" style="width:80px;height:22px;	line-height:22px;">Ejecutar</a>&nbsp;&nbsp;
    </div>
    <div style="float: left; margin-left: 10px; height: 40px;display: none;" id="buscar_1_dw">
        <img src="media/misc/csv-128.png"  class="mano" onclick="descargaCsv(1)" />
        <img src="media/misc/pdf-128.png"  class="mano" style="display: none;" />
    </div>    
    <div style="float: left; margin-left: 10px; height: 40px;" id="buscar_1_msg"></div>
    
</div>
<div style="width: 100%;display: none;" id="buscar_2">
    <div style="float: left">
        <div class="styled-select">
            <select id="sel_2" title="puede filtrar con solo el primer caracter">
                <option value="1">Nombre Cliente</option>
                <option value="2"># Celular</option>
                <option value="3"># Giro</option>                
            </select>
        </div>
    </div>
    <div style="float: left; margin-left: 10px; height: 40px;">
        <span style="color:black; font-size: 12px;line-height: 40px;"> <input type="text" value="" id="criteria" class="dateT" style="width: 150px;height: 30px;"></span>
    </div>
    <div style="float: left; margin-left: 10px; height: 40px;">
        <a href="javascript:buscarCriterio(2)" class="classname" style="width:80px;height:22px;	line-height:22px;">Ejecutar</a>&nbsp;&nbsp;
    </div>
    <div style="float: left; margin-left: 10px; height: 40px;display: none;"  id="buscar_2_dw">
        <img src="media/misc/csv-128.png" class="mano"  onclick="descargaCsv(2)" />
        <img src="media/misc/pdf-128.png" class="mano" style="display: none;" />
    </div>    
    <div style="float: left; margin-left: 10px; height: 40px;" id="buscar_2_msg"></div>
</div>
