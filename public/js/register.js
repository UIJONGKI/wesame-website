$(function(){
    //############ 18.register ############

			$("#film").hide();
			$(".registerContentTitle2").click(function(){
				$("#film").slideToggle(200);
                $(".registerContentTitle2 span").toggleClass("registerRote");
			});

			
            $("#film").prepend($(".scene:last"));
			$("#film").css({"marginLeft":"-100%"});

			$(".resgisterNextBtn").click(function(){
				$("#film").animate({"marginLeft":"-=100%"},400,"swing",function(){

					$("#film").append($(".scene:first"));
					$("#film").css({"marginLeft":"-100%"});
				});
			});
			$(".resgisterPrevBtn").click(function(){

				$("#film").animate({"marginLeft":"+=100%"},400,"swing",function(){

					$("#film").prepend($(".scene:last"));
					$("#film").css({"marginLeft":"-100%"});
				});
			});

            
    
            $("#registerSns ul li:eq(0)").on("mouseover focusin", function(){
                $(this).css({"backgroundColor":"#3b5998","borderColor":"#3b5998"});
                $(this).children("a").css({"color":"#fff"});
                $(this).children("a").children("img:first").css({"opacity":"0"});
                $(this).children("a").children("img:last").css({"opacity":"1"});
            });
            $("#registerSns ul li:eq(0)").on("mouseout focusout", function(){
                $(this).css({"backgroundColor":"#fff","borderColor":"#ccc"});
                $(this).children("a").css({"color":"#313131"});
                $(this).children("a").children("img:first").css({"opacity":"1"});
                $(this).children("a").children("img:last").css({"opacity":"0"});
            });
            $("#registerSns ul li:eq(1)").on("mouseover focusin", function(){
                $(this).css({"backgroundColor":"#d73d32","borderColor":"#d73d32"});
                $(this).children("a").css({"color":"#fff"});
                $(this).children("a").children("img:first").css({"opacity":"0"});
                $(this).children("a").children("img:last").css({"opacity":"1"});
            });
            $("#registerSns ul li:eq(1)").on("mouseout focusout", function(){
                $(this).css({"backgroundColor":"#fff","borderColor":"#ccc"});
                $(this).children("a").css({"color":"#313131"});
                $(this).children("a").children("img:first").css({"opacity":"1"});
                $(this).children("a").children("img:last").css({"opacity":"0"});
            });
            $("#registerSns ul li:eq(2)").on("mouseover focusin", function(){
                $(this).css({"backgroundColor":"#7b0099","borderColor":"#7b0099"});
                $(this).children("a").css({"color":"#fff"});
                $(this).children("a").children("img:first").css({"opacity":"0"});
                $(this).children("a").children("img:last").css({"opacity":"1"});
            });
            $("#registerSns ul li:eq(2)").on("mouseout focusout", function(){
                $(this).css({"backgroundColor":"#fff","borderColor":"#ccc"});
                $(this).children("a").css({"color":"#313131"});
                $(this).children("a").children("img:first").css({"opacity":"1"});
                $(this).children("a").children("img:last").css({"opacity":"0"});
            });
    
    
            $(".formBox").on("click focusin",function(){
                  $(this).children("label").css({"top":"-20px","fontSize":"12px"});
                $(this).css({"borderBottomColor":"#00519e"});
            });
            $(".formBox").on("focusout",function(){
                    
                    
                    if(!($(this).children("input").val()=="")){
                        $(this).children("label").css({"top":"-20px","fontSize":"12px"});
                        $(this).css({"borderBottomColor":"#00519e"});
                    }else{
                        $(this).children("label").css({"top":"0px","fontSize":"16px"});
                        $(this).css({"borderBottomColor":"#ccc"});
                    };
            });
    
			$(".toolTip, .toolTip2").hide();

			$(".formDateArea h4 strong").mouseover(function(){


				$(this).css({"backgroundColor":"#00519e","color":"#fff"});
				$(".toolTip1-1").fadeIn(300).css({"left":$(this).offset().left-65+"px","top":$(this).offset().top-125+"px"});
				$(".toolTip2-1").fadeIn(300).css({"left":$(this).offset().left-0+"px","top":$(this).offset().top-21+"px"});
			}).mouseout(function(){
				$(this).css({"backgroundColor":"#fff","color":"#515151"});
				$(".toolTip1-1").fadeOut(300);
				$(".toolTip2-1").fadeOut(300);
			});
			$(".formLocationArea h4 strong").mouseover(function(){

				$(this).css({"backgroundColor":"#00519e","color":"#fff"});
				$(".toolTip1-2").fadeIn(300).css({"left":$(this).offset().left-65+"px","top":$(this).offset().top-125+"px"});
				$(".toolTip2-2").fadeIn(300).css({"left":$(this).offset().left-0+"px","top":$(this).offset().top-21+"px"});
			}).mouseout(function(){
				$(this).css({"backgroundColor":"#fff","color":"#515151"});
				$(".toolTip1-2").fadeOut(300);
				$(".toolTip2-2").fadeOut(300);
			});
    
    
            $(".registerCheckArea label").click(function(){
                $(".registerCheckArea span").toggleClass("registerCheck2")
                $(".checkImg").toggleClass("registerCheck");
            });
    
            
            

});
