(function($) {

$.fn.innerfade = function(options) {

	this.each(function(){ 	
		
		var settings = {
			animationtype: 'fade',
			speed: 'normal',
			timeout: 2000,
			type: 'sequence',
			containerheight: 'auto',
			runningclass: 'innerfade'
		};
		
		if(options)
			$.extend(settings, options);
		
		var self = $(this);
		var elements = $(this).children();
		var interval;
		var current, last;
	
		if (elements.length > 1) {
		
			$(this).css('position', 'relative');
	
			$(this).css('height', settings.containerheight);
			$(this).addClass(settings.runningclass);
			
			for ( var i = 0; i < elements.length; i++ ) {
				$(elements[i]).css('z-index', String(elements.length-i)).css('position', 'absolute');
				$(elements[i]).hide();
			};
		
			if ( settings.type == 'sequence' ) {
				interval = setTimeout(function(){
					$.innerfade.next(elements, settings, 1, 0);
				}, settings.timeout);
				$(elements[0]).show();
			} else if ( settings.type == 'random' ) {
				interval = setTimeout(function(){
					do { current = Math.floor ( Math.random ( ) * ( elements.length ) ); } while ( current == 0 )
					$.innerfade.next(elements, settings, current, 0);
				}, settings.timeout);
				$(elements[0]).show();
			}	else {
				alert('type must either be \'sequence\' or \'random\'');
			}
			
			self.hover(function(){
				$.innerfade.stop();
			},function(){
				$.innerfade.start(elements, settings, current, last);
			});
				
		}
		
		
		start = function() {
			
		}
		stop = function(){
			
		}
		
	});
};


$.innerfade = function() {}
$.innerfade.next = function (elements, settings, current, last) {

	if ( settings.animationtype == 'slide' ) {
		$(elements[last]).slideUp(settings.speed, $(elements[current]).slideDown(settings.speed));
	} else if ( settings.animationtype == 'fade' ) {
		$(elements[last]).fadeOut(settings.speed);
		$(elements[current]).fadeIn(settings.speed);
	} else {
		alert('animationtype must either be \'slide\' or \'fade\'');
	};
	
	if ( settings.type == 'sequence' ) {
		if ( ( current + 1 ) < elements.length ) {
			current = current + 1;
			last = current - 1;
		} else {
			current = 0;
			last = elements.length - 1;
		};
	}	else if ( settings.type == 'random' ) {
		last = current;
		while (	current == last ) {
			current = Math.floor ( Math.random ( ) * ( elements.length ) );
		};
	}	else {
		alert('type must either be \'sequence\' or \'random\'');
	};
	$.innerfade.start(elements, settings, current, last);
}
$.innerfade.start = function(elements, settings, current, last) {
	interval = setTimeout((function(){$.innerfade.next(elements, settings, current, last);}), settings.timeout);
}
$.innerfade.stop = function(elements, settings, current, last){
	clearTimeout(interval);
}
})(jQuery);


$(document).ready(function(){
	
	$('#displayDestaque').innerfade({ 
		speed: 'slow', 
		timeout: 5000, 
		type: 'sequence', 
		containerheight: '218px'
	});
	
	$("input[name=search_theme_form]").val("Busca rapida").bind("focus", function(){																				
		if($(this).val() == "Busca rapida") {
			$(this).val("");
		} else {
			$(this).val($(this).val()); 
		}
	});
});
