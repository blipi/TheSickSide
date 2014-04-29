var _ = _ || {};

define([], function(){
	var Menu = function()
	{
		this.animationRunning = false;
		this.animationStop = false;
		this.$logo = null;
		this.$menu = null;
	};
	
	Menu.prototype.initialize = function()
	{
		// Set menu elements
		this.$menu = $("#menu");
		this.$logo = $("#logo");
				
		Modernizr.addTest('firefox', function () {
			return !!navigator.userAgent.match(/firefox/i);
		});
	
		// Apply lettering and text rotations
		if (Modernizr.csstransforms)
		{
			var $header = $("#name_header");
			var $footer = $("#name_footer");
			
			// Firefox won't be nice...
			if (Modernizr.firefox)
			{
				$header.offset({top: $header.offset().top + 22, left: $header.offset().left});
				$footer.offset({top: $footer.offset().top + 22, left: $footer.offset().left});
			}
			
			$header.lettering();
			$footer.text(
				$("#name_footer").text().split('').reverse().join('')
			)
			.lettering();
		}
		
		// Reposition menu items for other languages
		// Concerts
		var $concerts = $(".menu_concerts");
		var fix = "CONCERTS".length - $concerts.children('a').html().length;
		if (fix > 0)
			$concerts.css('padding-left', 7*fix + 'px');
		else if (fix < 0)
			$concerts.css('margin-left', 7*fix + 'px');
			
		// News
		var $news = $(".menu_news");
		fix = "NOTICIES".length - $news.children('a').html().length;
		if (fix != 0)
			$news.css('padding-left', 7*fix + 'px');
			
		// Discography
		var $disco = $(".menu_discography");
		fix = "DISCOGRAFIA".length - $disco.children('a').html().length;
		if (fix != 0)
			$disco.css('padding-right', 7*fix + 'px');
	};
		
	Menu.prototype.rotate = function()
	{
		this.animationRunning = true;
		this.animationStop = false;
		this._rotate();
		
		return this;
	},
		
	Menu.prototype._rotate = function()
	{
		$({deg: 0}).animate({deg: 360}, {
	        duration: 1500,
	        easing: "linear",
	        step: function(now) {
	            _.Menu.$logo.css({
	                transform: 'rotate(' + now + 'deg)'
	            });
	        },
	        complete: function(){
	        	if (_.Menu.animationStop)
        		{
	        		_.Menu.animationRunning = false;
        		}
	        	else
        		{
	        		_.Menu._rotate();
        		}
            }
	    });
	};
		
	Menu.prototype.rotateStop = function()
	{
		this.animationStop = true;
	},
		
	Menu.prototype.spin = function()
	{
		this._spin();
	},
		
	Menu.prototype._spin = function()
	{
		$({deg: 0}).animate({deg: 360}, {
	        duration: 1500,
	        step: function(now) {
	            _.Menu.$menu.css({
	                transform: 'rotate(' + now + 'deg)'
	            });
	        },
	        complete: function(){
	        	
            }
	    });
	};
	
	_.Menu = new Menu;
	return _.Menu;
});