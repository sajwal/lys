var $j = jQuery.noConflict();

$j(document).ready(function(){


	

//$j('li.level2').remove();

if('li.level2'){
//$j('li.level2').replaceWith('<div style="background:#006e9c; z-index:999; position:relative; left:0px; float:left; width:65px; height:65px; margin-right:10px; margin-left:10px; border-radius:5px;">New heading<p style="color:#fff; margin-top:35px;">New Div</p></div>');
$j('li.level2').remove();
$j('ul.level1').append(
'\
<div style="background:#006e9c url(../images/footwear.png) no-repeat; z-index:999; position:relative; left:0px; float:left; width:80px; height:77px; margin-right:3px; margin-left:5px; border-radius:5px;">\
<p style="color:#fff; margin-top:75px; text-transform:uppercase; font-size:13px; margin-left:5px;">\
<a href="footwear.html" style="color:#fff">Footwear</a>\
</div>\
\
<div style="background:#006e9c url(../images/equipment.png) no-repeat; z-index:999; position:relative; left:0px; float:left; width:80px; height:77px; margin-right:3px; margin-left:3px; border-radius:5px;">\
<p style="color:#fff; margin-top:75px; text-transform:uppercase; font-size:13px; margin-left:5px;">\
<a href="#" style="color:#fff">Equipment</a>\
</div>\
\
<div style="background:#006e9c url(../images/accessories.png) no-repeat; z-index:999; position:relative; left:0px; float:left; width:80px; height:77px; margin-right:3px; margin-left:3px; border-radius:5px;">\
<p style="color:#fff; margin-top:75px; text-transform:uppercase; font-size:13px; margin-left:2px;">\
<a href="#" style="color:#fff">Accessories</a>\
</div>\
\
<div style="background:#006e9c url(../images/apparel.png) no-repeat; z-index:999; position:relative; left:0px; float:left; width:80px; height:77px; margin-right:3px; margin-left:3px; border-radius:5px;">\
<p style="color:#fff; margin-top:75px; text-transform:uppercase; font-size:13px; margin-left:10px;">\
<a href="#" style="color:#fff">Apparel</a>\
</div>\
')
}


});