var $j = jQuery.noConflict();

$j(document).ready(function(){
	

	$j("dl#narrow-by-list dt").addClass('expandedlayered');
	
$j("dl#narrow-by-list dt").click(function () {

$j(this).next("dd").toggle("showOrHide");
$j(this).toggleClass('collapselayered', 'expandedlayered');
});




});