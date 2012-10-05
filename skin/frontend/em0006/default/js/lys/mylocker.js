/**
 * Author: damodar.bashyal
 * Date: 5/10/11
 * Time: 12:26 PM
 */
function slideUp()
{
	jQuery('#topCartContent:visible').slideUp(500);
	jQuery('.mini-cart-layer').addClass('mini-cart-layer-up');
	jQuery('.mini-cart-layer').removeClass('mini-cart-layer-down');
	jQuery('.block-title').removeClass('mini-cart-active')
}

function slideDown()
{
	jQuery('#topCartContent:hidden').slideDown(500);
	/*startTimer()*/ /* optional*/
	jQuery('.mini-cart-layer').addClass('mini-cart-layer-down');
	jQuery('.mini-cart-layer').removeClass('mini-cart-layer-up');
	jQuery('.block-title').addClass('mini-cart-active')
}

function toggleTopCart()
{
	if(jQuery('#topCartContent').is(':visible'))
	{
		slideUp();
	} else {
		slideDown();
	}
}

var timer;
function startTimer()
{
	timer = setTimeout(function(){
		slideUp();
	}, 10000);
}

//jQuery(document).ready(function(){
//	jQuery('.mini-cart-layer .top-cart .block-title #cartHeader').click(function(){
//		toggleTopCart();
//	});
//
//	jQuery('.mini-cart-layer .top-cart .block-title #cartHeader').mouseover(function(){
//		clearTimeout(timer);
//	}).mouseout(function(){
//		startTimer();
//	});
//
//	jQuery("#topCartContent").mouseover(function() {
//		clearTimeout(timer);
//	}).mouseout(function(){
//		startTimer();
//	});
//	
//	
//	$j("#afterlogin").mouseover(function(){
//	$j(".returns").hide()
//	$j("#lyslocker").hide()
//	});
//	$j("#afterlogin").mouseout(function(){
//	$j(".returns").show()
//	$j("#lyslocker").show()
//	});
//});