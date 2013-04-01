$(function(){
	$(".id").each(function(){
		
		var defaulttext= $(this).val();
		$(this).focus(function(){
			if($(this).val() == defaulttext){
				$(this).val("");
			}
		});

		$(this).blur(function(){
			if($(this).val() == ""){
				$(this).val(defaulttext);
			}

		});
	});
});