var $j = jQuery.noConflict();

$j(document).ready(function(){
			
			$j('div.cols').click(function(){
    		 window.location = $j(this).attr("url");
   			 return false;
			});
			
			$j("div.cols").hover(function(){
				$j(this).stop().css({"opacity": 0.7});
			},function(){
				$j(this).stop().css({"opacity": 1});
			});
			
			
			$j('div.abnd').click(function(){
    		 window.location = $j(this).attr("url");
   			 return false;
			});
			
			
			/* Removing the list items from featured products after first three*/
			$j(".newarrivals li:not(':eq(0)'):not(':eq(1)'):not(':eq(2)')").remove();
			
			
			/* Featured Products Slideup / slidedown */
			 
		
			$j("a.btn-slide").click(function(e) {
				e.preventDefault();
		
				var $jmenu = $j($j(this).attr("href"));
		
				$j(".radius").slideUp();
		
				if ($jmenu.is(":hidden")) {
					$jmenu.slideDown("slow");
				}
			});
			
	
			
		
			
  
  
});


