jQuery(document).ready(function(){
$j("#cash").hide();
$j("#avenue").show();
var online = "ul#checkout-payment-method-load li:first" 
var cash =   "ul#checkout-payment-method-load li:nth-child(2)"
$j(online).addClass('pactive')
$j('input[name=payment[method]]').filter('[value="avenues_standard"]').attr('checked', true);
	$j('input[name=payment[method]]').change(function(){
		$j("#cash").toggle();
		$j("#avenue").toggle();		
		//$j(this).parents('li.payments').toggleClass('pactive');		
		$j(online).toggleClass('pactive');
		$j(cash).toggleClass('pactive');  
});

	});
