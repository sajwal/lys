var $j = jQuery.noConflict();

$j(document).ready(function() {

function clickableDiv() {
    window.location = $j(this).find("a").attr("href");
}

$j("li.slide1").click(clickableDiv);
$j("li.slide2").click(clickableDiv);
$j("li.slide3").click(clickableDiv);
$j("li.slide4").click(clickableDiv);

});
