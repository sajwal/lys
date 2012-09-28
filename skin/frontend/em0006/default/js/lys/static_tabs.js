var $j = jQuery.noConflict();

$j(document).ready(function(){
			$j('.static_form').hide();
			$j('.static_returns').hide();

			$j('.tab1').click(function () {
				$j('.static_info').show();
				$j('.static_form').hide();	
				$j('.static_returns').hide()	
				
				$j('.tab1').addClass('black').removeClass('lwhiterblack').removeClass('lwhiterwhite');
				$j('.tab2').addClass('white').removeClass('lwhiterblack2').removeClass('rwhite');
				$j('.tab2rt').addClass('lwhiterwhite').removeClass('lwhiterwhite2');
				$j('.tab3').addClass('rwhite').removeClass('white');
			})
			
			$j('.tab2').click(function () {
			$j('.static_info').hide();
			$j('.static_form').show();
			$j('.static_returns').hide()	
			
			$j('.tab1').addClass('lwhiterblack').removeClass('black').removeClass('lwhiterwhite');
			$j('.tab2').addClass('lwhiterblack2').removeClass('white').removeClass('rwhite');
			$j('.tab2rt').addClass('lwhiterwhite2').removeClass('lwhiterwhite');
			$j('.tab3').addClass('white').removeClass('rwhite');
 
			
			
			})
			
			$j('.tab3').click(function () {
			$j('.static_info').hide();
			$j('.static_form').hide();
			$j('.static_returns').show()	
			
			
				$j('.tab1').addClass('lwhiterwhite').removeClass('black').removeClass('lwhiterblack');
				$j('.tab2').addClass('rwhite').removeClass('white').removeClass('lwhiterblack2');
				$j('.tab2rt').addClass('lwhiterblack').removeClass('lwhiterwhite2').removeClass('lwhiterwhite');
				$j('.tab3').addClass('lwhiterblack2').removeClass('white').removeClass('rwhite');
			
			})
});



