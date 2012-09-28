var $j = jQuery.noConflict();

 $j(document).ready(function() {

        //move he last list item before the first item. The purpose of this is if the user clicks to slide left he will be able to see the last item.

        $j('#carousel_ul li:first').before($j('#carousel_ul li:last')); 
		$j('#carousel_ul2 li:first').before($j('#carousel_ul2 li:last')); 
		$j('#carousel_ul3 li:first').before($j('#carousel_ul3 li:last')); 
		
		
        //when user clicks the image for sliding right
    		 $j('#right_scroll img').click(function(){    
  			//get the width of the items ( i like making the jquery part dynamic, so if you change the width in the css you won't have o change it here too ) '
			  var item_width = $j('#carousel_ul li').outerWidth() + 10;     
	    //calculae the new left indent of the unordered list
            var left_indent = parseInt($j('#carousel_ul').css('left')) - item_width;
            //make the sliding effect using jquery's anumate function '
            $j('#carousel_ul:not(:animated)').animate({'left' : left_indent},500,function(){ 
                //get the first list item and put it after the last list item (that's how the infinite effects is made) '
                $j('#carousel_ul li:last').after($j('#carousel_ul li:first'));   
                //and get the left indent to the default -210px
                $j('#carousel_ul').css({'left' : '-40px'});
            }); 

        });
		
		
		
		        //when user clicks the image for sliding right
    		 $j('#right_scroll2 img').click(function(){    
  			//get the width of the items ( i like making the jquery part dynamic, so if you change the width in the css you won't have o change it here too ) '
			  var item_width = $j('#carousel_ul2 li').outerWidth() + 10;     
	    //calculae the new left indent of the unordered list
            var left_indent = parseInt($j('#carousel_ul2').css('left')) - item_width;
            //make the sliding effect using jquery's anumate function '
            $j('#carousel_ul2:not(:animated)').animate({'left' : left_indent},500,function(){ 
                //get the first list item and put it after the last list item (that's how the infinite effects is made) '
                $j('#carousel_ul2 li:last').after($j('#carousel_ul2 li:first'));   
                //and get the left indent to the default -210px
                $j('#carousel_ul2').css({'left' : '30px'});
            }); 

        });
		
		
		
		
		        //when user clicks the image for sliding right
    		 $j('#right_scroll3 img').click(function(){    
  			//get the width of the items ( i like making the jquery part dynamic, so if you change the width in the css you won't have o change it here too ) '
			  var item_width = $j('#carousel_ul3 li').outerWidth() + 10;     
	    //calculae the new left indent of the unordered list
            var left_indent = parseInt($j('#carousel_ul3').css('left')) - item_width;
            //make the sliding effect using jquery's anumate function '
            $j('#carousel_ul3:not(:animated)').animate({'left' : left_indent},500,function(){ 
                //get the first list item and put it after the last list item (that's how the infinite effects is made) '
                $j('#carousel_ul3 li:last').after($j('#carousel_ul3 li:first'));   
                //and get the left indent to the default -210px
                $j('#carousel_ul3').css({'left' : '-40px'});
            }); 

        });


        

        //when user clicks the image for sliding left

        $j('#left_scroll img').click(function(){    
            var item_width = $j('#carousel_ul li').outerWidth() + 10;  
            /* same as for sliding right except that it's current left indent + the item width (for the sliding right it's - item_width) */
            var left_indent = parseInt($j('#carousel_ul').css('left')) + item_width;            
            $j('#carousel_ul:not(:animated)').animate({'left' : left_indent},500,function(){      
            /* when sliding to left we are moving the last item before the first list item */   
            $j('#carousel_ul li:first').before($j('#carousel_ul li:last'));            
            /* and again, when we make that change we are setting the left indent of our unordered list to the default -210px */
            $j('#carousel_ul').css({'left' : '-210px'});
            });
        });
		
		
		        //when user clicks the image for sliding left

        $j('#left_scroll2 img').click(function(){    
            var item_width = $j('#carousel_ul2 li').outerWidth() + 10;  
            /* same as for sliding right except that it's current left indent + the item width (for the sliding right it's - item_width) */
            var left_indent = parseInt($j('#carousel_ul2').css('left')) + item_width;            
            $j('#carousel_ul2:not(:animated)').animate({'left' : left_indent},500,function(){      
            /* when sliding to left we are moving the last item before the first list item */   
            $j('#carousel_ul2 li:first').before($j('#carousel_ul2 li:last'));            
            /* and again, when we make that change we are setting the left indent of our unordered list to the default -210px */
            $j('#carousel_ul2').css({'left' : '-210px'});
            });
        });
		
		
		
		
			        //when user clicks the image for sliding left

        $j('#left_scroll3 img').click(function(){    
            var item_width = $j('#carousel_ul3 li').outerWidth() + 10;  
            /* same as for sliding right except that it's current left indent + the item width (for the sliding right it's - item_width) */
            var left_indent = parseInt($j('#carousel_ul3').css('left')) + item_width;            
            $j('#carousel_ul3:not(:animated)').animate({'left' : left_indent},500,function(){      
            /* when sliding to left we are moving the last item before the first list item */   
            $j('#carousel_ul3 li:first').before($j('#carousel_ul3 li:last'));            
            /* and again, when we make that change we are setting the left indent of our unordered list to the default -210px */
            $j('#carousel_ul3').css({'left' : '-210px'});
            });
        });
		
		
		
		
		

  });
  
  
