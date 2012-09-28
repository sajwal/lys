var $j = jQuery.noConflict();

$j(document).ready(function(){
			$j('.bulk-order-form').hide();

			$j('.bulk-order-button').click(function () {
				$j('.bulk-order-form').show();
				$j('.special-order-form').hide();		
			})
			
			$j('.special-order-button').click(function () {
			$j('.bulk-order-form').hide();
			$j('.special-order-form').show();		
			})
});



