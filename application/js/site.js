
var Site = {

	baseUrl: null,

	initialize: function()
	{
		this.baseUrl = $('body').data('baseurl');
		this.SlideShow.initialize();
		this.Menu.initialize();
	},
	
	changeLang: function(lang, module)
	{
		location.href = this.baseUrl + "home/lang/" + lang + "/" + module + "/"; 
	},
	
	Menu: {
		animationRunning: {},
		
		initialize: function()
		{
			// Hook all items
			$('#menuWrapper').find('a').mouseenter(this._onHover);
		},
		
		_onHover: function(e)
		{
			var id = e.delegateTarget.id;
			if (typeof(Site.Menu.animationRunning[id]) !== undefined)
			{
				if (Site.Menu.animationRunning[id] == true)
					return;
			}
			
			Site.Menu.animationRunning[id] = true;
			
			// Set variables
			var $target = $(e.delegateTarget);
			
			// Set a placeholder
			var $placeholder = $('<a />')
			.css({position: 'absolute', left: $target.offset().left + 'px', top: $target.offset().top, width: $target.width(), height: $target.height()})
			.appendTo('body')
			.attr('href', $target.attr('href'))
			.click(Router._hook);
			
			// Animate
			$target.animate({
				top: 0,
				'z-index': 0
			}, 'fast')
			.animate({
				top: '-=30',
				'z-index': '-1'
			}, 'fast')
			.animate({
				top: '+=60',
				'z-index': 0
			})
			.animate({
				top: 0,
			}, function(){
				Site.Menu.animationRunning[id] = false;
				
				// If mouse is still over, avoid playing the animation once we remove the placeholder
				if ($placeholder.is(':hover'))
				{
					$target.unbind('mouseenter').mouseenter(Site.Menu._rehook);
				}
				
				// Remove the placeholder
				$placeholder.remove();
			});
		},
		
		_rehook: function(e)
		{
			$(e.delegateTarget).mouseenter(Site.Menu._onHover);
		}
	},
	
	SlideShow: {
		
		visible: false,
		hidden: false,
		
		initialize: function()
		{
			this.visible = $('#slideshow').is(':visible');
		},
		
		hide: function()
		{
			if (this.visible && !this.hidden)
			{
				$('#slideshow').animate({height: '0px', opacity: '0'}, '50%', function(){
					Site.SlideShow.hidden = true;
				});
			}
		},
		
		show: function(force)
		{
			if ((this.visible && this.hidden) || force)
			{
				$('#slideshow').css({height: '0px', opacity: '0'}).show().animate({height: '250px', opacity: '1'}, '50%', function(){
					Site.SlideShow.hidden = false;
					Site.SlideShow.visible = true;
				});
			}
		},
	}
}

$(document).ready(function()
{
	function checkIfLoaded()
	{
		if(typeof Site != "undefined")
		{
			Site.initialize();
		}
		else
		{
			setTimeout(checkIfLoaded, 50);
		}
	}
	
	checkIfLoaded();
});