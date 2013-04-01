jQuery().ready(function(){
	$(".ascenseur").next("div").hide();
	$(".ascenseur").click(function(){
		if($(this).next("div").is(":hidden")){
			$(".ascenseur").next("div:visible").slideUp();
			$(this).next("div").slideDown();
		}
		else {
			$(this).next("div").slideUp();
		}
	});
});