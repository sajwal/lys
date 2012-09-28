var $j = jQuery.noConflict();

$j(document).ready(function(){



    $j("div.product-info-wrapper").hover(function () {
        $j(this).addClass("product-info-color");
		$j(".grid-price-mrp h2, .grid-price h4,.grid-price-mrp .price span, .grid-name a, .grid-price-mrp .price",$j(this).parent()).css("color","white");
		$j(".grid-discount",$j(this).parent()).css("color","white");
    },
    function () {
        $j(this).removeClass("product-info-color");
		$j(".grid-price-mrp .price span,.grid-price-mrp .price").css("color","#E96608");
		$j(".grid-name a,.grid-price h4").css("color","#006c9b");
		$j(".grid-price-mrp h2").css("color","#000000")
		$j(".grid-discount",$j(this).parent()).css("color","#E96608");
    });

	$j(".product-info-wrapper").click(function(){
		 window.location=$j(this).find("a").attr("href");
		 return false;
	});


			
});



