function onAfter(curr, next, opts) {
	var index = opts.currSlide;
	var url = ['treinamentos/','profissional/','esportiva/','eventos/'];
	$("ul#displayDestaque li").css("cursor","pointer").children().click(function(){
		window.location = url[index];	
	});
}

$(document).ready(function(){
						   
	$("#block-nice_menus-1 ul#nice-menu-1 li a").wrapInner("<span></span>");
	
	$("a[href^=#]").click(function(){ return false; });
	
	$('#displayDestaque').cycle({ 
		fx:     'fade', 
		speed:       600, 
		timeout:     5000, 
		pager:      '.wrap-destaque-home #pager', 
		pagerEvent: 'click',
		pause:   1,
		pauseOnPagerHover: true, //,cleartype:$.support.opacity
		after: onAfter
	});
	
	$("input[name=search_theme_form]").val("Busca no site").bind("focus", function(){																				
		if($(this).val() == "Busca no site") {
			$(this).val("");
		} else {
			$(this).val($(this).val()); 
		}
	});
	
	$("#pager a").html("").eq(0).css("background-color","#c2251b").end().eq(1).css("background-color","#5a5a5a").end().eq(2).css("background-color","#00939b").end().eq(3).css("background-color","#d7a806");
	
	
	$("#txthome .item").eq(0).show().end().find("a").eq(0).addClass("active");
	$("#txthome table.controle a").bind("click",function(){
		$("#txthome div.item").hide();
		$("#txthome div." + $(this).attr("id")).show();	
		$("#txthome table.controle a").removeClass("active");
		$(this).addClass("active");
	});
	
	
	/*
	
	*/
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs_menu li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content
	
	//On Click Event
	$("ul.tabs_menu li").live("mouseover", function() {
		$("ul.tabs_menu li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		$(activeTab).show(); //Fade in the active content
		return false;
	});
	
});
