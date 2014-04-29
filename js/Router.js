var _ = _ || {};

define(['Site'], function(){
	var Router = function()
	{
		this.loadedJS = [];
		this.loadedCSS = [];
		this.page = false;
		this.first = true;
	};
	
	/**
	 * Assign click events
	 */
	Router.prototype.initialize = function()
	{
		// Check for pushState support
		if(history.pushState)
		{
			// Assign AJAX loading behavior to all our internal links
			$("a[href*='" + _.Site.baseUrl + "']").each(function()
			{
				// Make sure it has not been assigned already
				if(!$(this).attr('data-hasEvent') && $(this).attr("target") != "_blank")
				{
					$(this).attr('data-hasEvent', '1');

					// Add the event listener
					$(this).click(_.Router._hook);
				}
			});
			
			window.addEventListener('popstate', _.Router._pop);
			
			requirejs.config({
			    //By default load any module IDs from js/lib
			    baseUrl: _.Site.baseUrl + 'js/',
			    
			    shim: {
			    	'tinymce/tinymce.min': {
			    		exports: 'tinymce'
			    	},
			    	
			        'tinymce/jquery.tinymce.min': {
			            deps: ['tinymce/tinymce.min', 'jquery'],
			            exports: 'jQuery.fn.tinymce'
			        },
			        
			        'plupload/i18n/ca': {
			        	deps: ['plupload/plupload.full.min'],
			        }
			    }
			});
		}
	};
		
	Router.prototype._pop = function(event)
	{
		if (_.Router.first)
		{
			_.Router.first = false;
			return;
		}
		
		if (event.state)
			_.Router._load(event.state);
		else
			_.Router.load(location.href, 0, false);
			
		event.preventDefault();
	},
		
	Router.prototype._hook = function(event)
	{
		// Middle button, skip
		if (event.which == 2)
			return true;
		
		// Indicate the loading
		$("html").css("cursor", "wait");

		// Get the link
		var href = $(event.delegateTarget).attr("href");
		var direct = $(event.delegateTarget).attr("direct");

		// Load it via AJAX
		_.Router.load(href, direct);

		// Prevent it from refreshing the whole page
		event.preventDefault();
	};

	/**
	 * Load the link into the content area
	 * @param String link
	 */
	Router.prototype.load = function(link, direct, spin)
	{			
		_.Router.page = link;
		
		if (typeof spin == "undefined")
			spin = true;
		
		if(/logout/.test(link))
		{
			window.location = link;
		}
		else if(direct == "1")
		{
			window.location = link;
		}
		else
		{
			if (spin)
				_.Menu.spin();
			
			// Load the page
			$.get(link, { is_json_ajax: "1" }, function(data, textStatus, response)
			{
				// Full page response? Redirect instead
				if(/^\<!DOCTYPE html\>/.test(data))
				{
					window.location.reload(true);

					return;
				}

				if(_.Router.page == link)
				{
					window.scrollTo(0, 0);
					try
					{
						data = JSON.parse(data);
					}
					catch(error)
					{
						data = {
							title: "Error",
							content: "Something went wrong!<br /><br /><b>Technical data:</b> " + data,
							js: null,
							css: null,
							language: false
						};
					}
					data.href = link;
					_.Router._load(data);
					
					if (history.state && history.state.href == data.href)
						history.replaceState(data, data.title, link);
					else
						history.pushState(data, data.title, link);
				}
			}).fail(function()
			{
				if(_.Router.page == link)
				{
					$("body").css("cursor", "default");
					$("title").html("The Sick Side");
					//UI.alert("Something went wrong! Attempting to load the page directly... <center style='margin-top:20px;'><img src='" + Site.baseUrl + "application/images/modal-ajax.gif' /></center>", 3000);

					setTimeout(function()
					{
						window.location = link;
					}, 3000);
				}
			});
		}
	};
		
	Router.prototype._load = function(data)
	{
		// Change the cursor back to normal
		$("html").css("cursor", "default");

		// Change the content
		$("#content").html(data.content);

		// Change the title
		$("title").html(data.title);
		
		// Change the module
		$('body').data('module', data.module);

		// Make sure to assign the router to all new internal links
		_.Router.initialize();

		// Add the CSS if it exists and hasn't been loaded already
		if($.inArray(data.css, _.Router.loadedCSS) == -1 && data.css.length > 0)
		{
			_.Router.loadedCSS.push(data.css);

			$("head").append('<link rel="stylesheet" type="text/css" href="' + _.Site.baseUrl + 'style/stylesheets/' + data.css + '.css" />');
		}

		for (var k = 0; k < data.js.length; k++)
		{
			require([data.js[k]], function(obj){
				if (typeof obj != 'undefined' && 'initialize' in obj)
				{
					obj.initialize();
				}
			});
		}
	};
	
	_.Router = new Router;
	return _.Router;
});
