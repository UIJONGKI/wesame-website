$(function(){
    /* main-visual */
    $(".main-film").prepend($(".main-scene:last"));
    $(".main-film").css({"marginLeft":"-100%"});
    
    $(".main-visual-btn-next").click(function(){

            $(".main-film").animate({"marginLeft":"-=100%"},340,"swing",function(){
            
                $(".main-film").append($(".main-scene:first"));
				$(".main-film").css({"marginLeft":"-100%"});    
        });
    });
    $(".main-visual-btn-prev").click(function(){

            $(".main-film").animate({"marginLeft":"+=100%"},340,"swing",function(){

                $(".main-film").prepend($(".main-scene:last"));
                $(".main-film").css({"marginLeft":"-100%"});
        });
    });
});