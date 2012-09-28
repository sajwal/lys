var $j = jQuery.noConflict();

$j(document).ready(function(){

$j("ul#static_nav li a").css({"opacity" : 0}).hover(function(){
		$j(this).stop().animate({"opacity" : 1}, 200); //Change fade-in speed
	
		}, function(){
		$j(this).stop().animate({"opacity" : 0}, 100);//Change fade-out speed
	
	});


});