var Router = {

	loadedJS: [],
	loadedCSS: [],
	first: true,
	page: false,

	/**
	 * Assign click events
	 */
	initialize: function()
	{
		// Check for pushState support
		if(history.pushState)
		{
			// Assign AJAX loading behavior to all our internal links
			$("a[href*='" + Site.baseUrl + "']").each(function()
			{
				// Make sure it has not been assigned already
				if(!$(this).attr('data-hasEvent') && $(this).attr("target") != "_blank")
				{
					$(this).attr('data-hasEvent', '1');

					// Add the event listener
					$(this).click(Router._hook);
				}
			});
		}
	},
	
	_hook: function(event)
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
		Router.load(href, direct);

		// Add it to the history object
		history.pushState('', 'New URL: ' + href, href);

		// Prevent it from refreshing the whole page
		event.preventDefault();
	},

	/**
	 * Load the link into the content area
	 * @param String link
	 */
	load: function(link, direct)
	{
		if(Router.first)
		{
			Router.first = false;

			// Make it load the page if they press back or forward
			$(window).bind('popstate', function()
			{
				Router.load(location.pathname, 0);
			});
		}
			
		Router.page = link;
		
		$("#tooltip").hide();

		if(/logout/.test(link))
		{
			window.location = link;
		}
		else if(/admin/.test(link))
		{
			window.location = link;
		}
		else if(direct == "1")
		{
			window.location = link;
		}
		else
		{
			// Load the page
			$.get(link, { is_json_ajax: "1" }, function(data, textStatus, response)
			{
				// Full page response? Redirect instead
				if(/^\<!DOCTYPE html\>/.test(data))
				{
					window.location.reload(true);

					return;
				}

				if(Router.page == link)
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

					// Change the cursor back to normal
					$("html").css("cursor", "default");

					// Change the content
					$("#content_ajax").html(data.content);

					// Change the title
					$("title").html(data.title);

					// Make sure to assign the router to all new internal links
					Router.initialize();

					if(data.language)
					{
						Language.set(data.language);
					}

					// Add the CSS if it exists and hasn't been loaded already
					if($.inArray(data.css, Router.loadedCSS) == -1 && data.css.length > 0)
					{
						Router.loadedCSS.push(data.css);

						$("head").append('<link rel="stylesheet" type="text/css" href="' + Site.baseUrl + 'application/' + data.css + '" />');
					}
					
					alert(data.js);
					// Add the JS if it exists and hasn't been loaded already
					if($.inArray(data.js, Router.loadedJS) == -1 && data.js.length > 0)
					{
						Router.loadedJS.push(data.js);

						require([Site.baseUrl + "application/" + data.js]);
					}
				}
			}).fail(function()
			{
				if(Router.page == link)
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
	}
}


$(document).ready(function()
{
	function checkIfLoaded()
	{
		if(typeof Router != "undefined")
		{
			Router.initialize();
		}
		else
		{
			setTimeout(checkIfLoaded, 50);
		}
	}
	
	checkIfLoaded();
});
