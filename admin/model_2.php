                    <div class="tituloModulo">MODULO DE PROCESO DE SMS</div>
                    <div class="closeModulo" onclick="closeModulo(2)">[ close window ] &nbsp;&nbsp;</div>
                    <br><br>
                    <div style="position: absolute; top: 40px;left: 280px;">
                        <!--img src="media/actualizar.png" width="30" onclick="refrescaGrilla()"  class="mano" title="[ Actualizar Contenido ]"/-->
                    </div>
                    <div id="selectControl" style="height: 40px; z-index: 654564;position: absolute;top: 40px;left: 15px;display: none;">
                    <!--SELECT-->
                    <ul id="select" class="select-group" style="z-index: 564564;">
                     <li class="select-box"></li>
                     <li value="1"  class="select-selected">Bandeja de Entrada</li>
                     <li value="2"  >Archivados</li>
                     </ul>
                     <!--SELECT-->                        
                    </div>
                    <div style="float: right; height: 40px;">
                        <div id="win_1" style="display: block;height: 40px;"> 
                        <a href="javascript:PorProcesar()" class="classname"  >Archivar Seleccionadas</a>&nbsp;&nbsp;
                        <input  type="hidden" id="enfoque"/>
                        </div>
                        <div id="win_2" style="display: none;height: 40px;"> 
                            
                        </div>
                        <div id="win_3" style="display: none;height: 40px;"> 
                            <a href="javascript:PorProcesarDepositos()" class="classname">Procesar Seleccionadas</a>&nbsp;&nbsp;
                        </div>
                        <div id="win_4" style="display: none;height: 40px;"> 
                            <a href="javascript:ReenviarFecha()" class="classname"  >Reenviar Seleccionados</a>&nbsp;&nbsp;
                        </div>
                        <div id="win_5" style="display: none;height: 40px;"> 
                        <a href="javascript:EnviarPorProcesar()" class="classname"  >Enviar a 'Por Procesar'</a>&nbsp;&nbsp;
                        </div>
                    </div>
                    <div style="clear: both"></div>
                    
                    <div id="window_1" style="display: block;position: relative:">
                                <div style="position: absolute; background: rgba(0, 0, 0,0.4); width: 800px; height: 580px;z-index: 65465;display: none;" id="bloqueo1">
                                    <br><br>
                                    <div style="clear: both"></div>
                                        <div style="font-size: 12px;width: 300px; margin-top: 100px;   margin: 0 auto; border-radius: 9px 9px 9px 9px;background-color: white; padding: 50px;" >
                                            <span id="msgAlert1">Por favor espere, mientras se procesa...</span>
                                        <div id="progressBar1" class="progressBar default"><div></div></div>
                                        </div>
                                </div>
                            <table id="list0"></table> <div id="pager0"></div>
                    </div>
                    <div id="window_2" style="display: none;position: relative:">
                                <div style="position: absolute; background: rgba(0, 0, 0,0.4); width: 800px; height: 580px;z-index: 65465;display: none;" id="bloqueo2">
                                    <br><br>
                                    <div style="clear: both"></div>
                                        <div style="font-size: 12px;width: 300px; margin-top: 100px;   margin: 0 auto; border-radius: 9px 9px 9px 9px;background-color: white; padding: 50px;" >
                                            <span id="msgAlert2">Por favor espere, mientras se procesa...</span>
                                        <div id="progressBar2" class="progressBar default"><div></div></div>
                                        </div>
                                </div>                     
                        <div style="width: 100%">
                            <div style="text-indent: 15px;">
                                 
                            </div>
                        </div>
                        <table id="list1"></table> <div id="pager1"></div>
                    </div>
                    <div id="window_3" style="display: none;position: relative:">
                                <div style="position: absolute; background: rgba(0, 0, 0,0.4); width: 800px; height: 580px;z-index: 65465;display: none;" id="bloqueo3">
                                    <br><br>
                                    <div style="clear: both"></div>
                                        <div style="font-size: 12px;width: 300px; margin-top: 100px;   margin: 0 auto; border-radius: 9px 9px 9px 9px;background-color: white; padding: 50px;" >
                                            <span id="msgAlert3">Por favor espere, mientras se procesa...</span>
                                        <div id="progressBar3" class="progressBar default"><div></div></div>
                                        </div>
                                </div>                          
                        
                        <table id="list2"></table> <div id="pager2"></div>
                    </div>
                    <div id="window_4" style="display: none;position: relative:">
                                <div style="position: absolute; background: rgba(0, 0, 0,0.4); width: 800px; height: 580px;z-index: 65465;display: none;" id="bloqueo4">
                                    <br><br>
                                    <div style="clear: both"></div>
                                        <div style="font-size: 12px;width: 300px; margin-top: 100px;   margin: 0 auto; border-radius: 9px 9px 9px 9px;background-color: white; padding: 50px;" >
                                            <span id="msgAlert4">Por favor espere, mientras se procesa...</span>
                                        <div id="progressBar4" class="progressBar default"><div></div></div>
                                        </div>
                                </div>                          
                        <div style="width: 100%">
                            <div style="text-indent: 15px;">
                                <b class="controlesLabel">#Giro</b> <input type="text" value="" class="controlesTxt" id="numGiro2"/> <input  class="controles mano" type="button" value="Buscar" onclick="filtraCnt2()"/> <input   class="controles mano" onclick="grillaClear2()" type="button" value="Todos"/>
                                <br><br>
                            </div>
                        </div>                        
                        <table id="list3"></table> <div id="pager3"></div>
                    </div>
                    <div id="window_5" style="display: none;position: relative:">
                            <div style="position: absolute; background: rgba(0, 0, 0,0.4); width: 800px; height: 580px;z-index: 65465;display: none;" id="bloqueo5">
                                <br><br>
                                <div style="clear: both"></div>
                                    <div style="font-size: 12px;width: 300px; margin-top: 100px;   margin: 0 auto; border-radius: 9px 9px 9px 9px;background-color: white; padding: 50px;" >
                                        <span id="msgAlert5">Por favor espere, mientras se procesa...</span>
                                    <div id="progressBar5" class="progressBar default"><div></div></div>
                                    </div>
                            </div>
                        <table id="list4"></table> <div id="pager4"></div>
                    </div>.