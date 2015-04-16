$(function(){
	//variable para controlar el movimiento del fondo
	var blnDetener=true;
 
	
	//intervalo de movimiento para las nubes
	var tmrNubes=setInterval(function(){
		//obtenemos el background-position
		var strPosicion=$('#divNubes').css('background-position');
		var iPosicion=strPosicion.indexOf('px');
		
		if(iPosicion!=-1){
			//movemos el fondo de nubes 1 pixel
			$('#divNubes').css('background-position',(parseInt(strPosicion.substr(0,iPosicion)))+1+'px 0');
		}else{
			//establecemos la posicion predeterminada del fondo de nubes
			//esta es la primera vez que la animacion se ejecuta
			$('#divNubes').css('background-position','1px 0');
		}
	},TIEMPONUBE);
	 
});      