function inicio(){
    document.location.href='index.html';
}
var izq= true;
var moverFlor = function(){
    var elemento='flor1';
    if(document.getElementById(elemento)){
        if(izq){
            izq= false;
            $("#"+elemento).animate({rotate: '3'},500);

        }else{
            izq= true;
            $("#"+elemento).animate({rotate:'-3'},500);
        }
        setTimeout("moverFlor()",500);
    }
};
var izq1= true;
var moverFlor2 = function(){
    var elemento='flor2';
    if(document.getElementById(elemento)){
        if(izq1){
            izq1= false;
            $("#"+elemento).animate({rotate: '3'},500);

        }else{
            izq1= true;
            $("#"+elemento).animate({rotate:'-3'},500);
        }
        setTimeout("moverFlor2()",500);
    }
};
var moverMariposa1 = function(){
    if(document.getElementById("mari1")){
    $("#mari1").hide();
        //({left:'-=5px'},1000);
        $("#mari1").fadeIn("slow").animate({left: '+=200px'},1500,function(){
            $(this).animate({left: '+=50px',marginTop: '-=280px'},1500,function(){
                $(this).animate({left: '-=50px',marginTop: '+=280px'},1500,function(){
                    $(this).animate({left: '-=200px'},1500,function(){
                        moverMariposa1();
                    });
                }); 
            });
        }    
        );    
    }      
};
var moverMariposa2 = function(){
    if(document.getElementById("mari2")){
    $("#mari2").hide();
        //({left:'-=5px'},1000);
        $("#mari2").fadeIn("slow").animate({left: '+=370px'},1500,function(){
            $(this).animate({left: '-=30px',marginTop: '+=200px'},3000,function(){
                $(this).animate({left: '+=30px',marginTop: '-=200px'},3000,function(){
                    $(this).animate({left: '-=370px'},3000,function(){
                        moverMariposa2();
                    });
                }); 
            });
        }    
        );    
    }      
};
$(document).ready(function(){
        if(document.getElementById("mundo")){
            $("#arcoiris").css({"visibility":"hidden"});
            $("#texto").css({"visibility":"hidden"});
            $("#mundo").hide();
            $("#mundo").fadeIn("slow").animate({rotate: '360'}, 3000,function(){
                    $("#arcoiris").css({"visibility":"visible"}).fadeIn(3000,function(){
                            $(this).animate({rotate: '360'}, 2000,function(){
                                    $("#texto").css({"visibility":"visible"});
                                    moverMariposa1();
                                    moverMariposa2();
                            });
                    });	
            });
        }
	$("#lapiz1").hover(function(){
		$(this).stop();
		$(this).animate({marginTop:"-12"},600);
	},function(){
		$(this).stop();
		$(this).animate({marginTop:"0"},600);
	});
        $("#lapiz3").hover(function(){
		$(this).stop();
		$(this).animate({marginTop:"-12"},600);
	},function(){
		$(this).stop();
		$(this).animate({marginTop:"0"},600);
	});
        $("#lapiz4").hover(function(){
		$(this).stop();
		$(this).animate({marginTop:"-12"},600);
	},function(){
		$(this).stop();
		$(this).animate({marginTop:"0"},600);
	});
        
        $("#lapiz5").hover(function(){
		$(this).stop();
		$(this).animate({marginTop:"-12"},600);
	},function(){
		$(this).stop();
		$(this).animate({marginTop:"0"},600);
	});
        
        moverFlor();
        moverFlor2();
        
    /*************************************************/
        //puertaAbierta
        $("#puertaAbierta").hover(function(){
		$("#puerta").addClass("puertaBG");
	},function(){
                $("#puerta").removeClass("puertaBG");
	});
        // ventana
        var venta = true;
        var tmrVentana=setInterval(function(){
            if(venta){
		 $('#idVentana').css("background-image", ""); 
                 venta=false;
            }else{
                 venta=true;
                 $('#idVentana').css("background-image", "url(img/ventana_l.png)"); 
            }     
	},1000);
        $('#idVentana').click(function(){document.location.href="galeria.php";});
        $('#puertaAbierta').click(function(){document.location.href="qsomos.php";});
        
        $('#lapiz1').click(function(){document.location.href="valores.php";});
        $('#lapiz3').click(function(){document.location.href="mision.php";});
        $('#lapiz5').click(function(){document.location.href="servicios.php";});
        $('#lapiz4').click(function(){document.location.href="ambientes.php";});
        $('#lapiz7').click(function(){document.location.href="galeria.php";});
        
        $('#buzon').click(function(){document.location.href="contacto.php";});
});