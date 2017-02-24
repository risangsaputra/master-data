(function(){
	console.log("lol");
	$(".network, .os, .web").on("click", function(){
		$(this).toggleClass("open");
		$(this).siblings().removeClass("open");
	});
})();