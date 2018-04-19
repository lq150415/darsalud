$(document).ready(main);
var contador = 1;
var contadores = 1; 
var ver = 0; 
function main () {
	$('.menu_bar').click(function(){
		if (contador == 1) {
			$('nav.vert').animate({
				right: '0'
			});
			if(contadores==0){
			$('nav.lateral').animate({
				left: '-100%'
			});
		}
			contador = 0;
			contadores=1;

		} else {
			contador = 1;
		
			$('nav.vert').animate({
				right: '-100%'
			});
			
			if(contadores==0){
			$('nav.lateral').animate({
				left: '-100%'
			});
			contadores = 0;
		}
			
		}
	});

	$('.menu_bar2').click(function(){
		if (contadores == 1) {
			$('nav.lateral').animate({
				left: '0'
							});
			if(contador==0){
			$('nav.vert').animate({
				right: '-100%'
			});
		}
			contadores = 0;
			contador=1;
		} else {
			contadores = 1;
			$('nav.lateral').animate({
				left: '-100%'
			});
		if(contador==0){
			$('nav.vert').animate({
				right: '-100%'
			});
			contador = 0;
		}
			
	
		}
	
 
});
	// Mostramos y ocultamos submenus
	
	
}