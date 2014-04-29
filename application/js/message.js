
var Message = {

	initialize: function()
	{
		setTimeout(Message.fadeOut, 7000);
		Message.fadeIn();
	},
	
	fadeIn: function()
	{
		Site.SlideShow.hide();
		$('#message').animate({height: '47px', opacity: '1'}, '50%');
	},
	
	fadeOut: function()
	{
		$('#message').animate({height: '0px', opacity: '0'}, '50%', function(){
			$('#message').remove();
		});
		Site.SlideShow.show();
	},
}

$(document).ready(function()
{
	function checkIfLoaded()
	{
		if(typeof Message != "undefined")
		{
			Message.initialize();
		}
		else
		{
			setTimeout(checkIfLoaded, 50);
		}
	}
	
	checkIfLoaded();
});