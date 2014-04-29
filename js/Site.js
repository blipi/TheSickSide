/*
$(document).ready(function()
{
	
	$.reject({  
	    reject: { all: false, msie5: true, msie6: true, msie7: true, msie8: true }, // Reject all renderers for demo
	    display: ['chrome','firefox','opera'],
	    closeCookie: true,
	    imagePath: './style/images/',
	    header: '<center>Su navegador no es soportado</center>', // Header Text  
	    paragraph1: 'Estás utilizando un navegador viejo, y no podrás gozar de la web en su totalidad', // Paragraph 1  
	    paragraph2: 'Instala uno de los siguientes para visualizar correctamente la web',
	    closeLink: 'Cerrar esta ventana',
	    closeMessage: 'Cierra esta ventana bajo tu conciencia!' // Message below close window link  
	});
});
*/

var _ = _ || {};

define('Site', ['Sound'], function(){
	var Site = function()
	{	
		this.baseUrl = null;
		this.$loader = null;
		this.$play = null;
		this.$pause = null;
		this.$stop = null;
		this.$volume = null;
		this.$fade = null;
		this.lastPlayed = '';
	};

	Site.prototype.initialize = function()
	{
		this.baseUrl = $('body').data('baseurl');

		this.$loader = $("#loader");
		this.$play = $("#play");
		this.$pause = $("#pause");
		this.$stop = $("#stop");
		this.$fade = $("#fade");
		
		this.$volume = $("#slider").slider({ value: 100 });		
		this.$volume.on("slide", this._volumeChanged);
		this.$volume.on("slidechange", this._volumeChanged);
		
		this.lastPlayed = this.baseUrl + 'audio/test.mp3';
		
		this._setupCallbacks();
		//this.playSound();
	};
		
	Site.prototype._setupCallbacks = function()
	{
		_.Sound.addEvent("play", this._soundPlaying, this);
		_.Sound.addEvent("resume", this._soundPlaying, this);
		_.Sound.addEvent("complete", this._soundEnd, this);
	};
		
	Site.prototype.playSound = function()
	{
		if (!_.Sound.canPlay)
		{
			return false;
		}
		
		_.Sound.play(this.lastPlayed);
		this.$play.unbind('click');
		return true;
	};
		
	Site.prototype.stopSound = function()
	{
		_.Sound.stop();
		this._soundEnd();
	};
		
	Site.prototype.pauseSound = function()
	{
		if (_.Sound.pause())
		{
			_.Menu.rotateStop();
			this.toggleMedia();
			this.$play.click(this.resumeSound);
		}
	};
		
	Site.prototype.resumeSound = function()
	{
		if (this.playSound())
		{
			_.Menu.rotate();
			this.toggleMedia();
		}
	};
		
	Site.prototype._soundPlaying = function()
	{
		_.Menu.rotate();
		_.Site.toggleMedia();
		_.Site.$loader.width(0).hide();
	};
		
	Site.prototype._soundEnd = function()
	{
		_.Menu.rotateStop();
		_.Site.toggleMedia(true);
		_.Site.$play.bind('click', this.playSound);
	};
		
	Site.prototype._volumeChanged = function(e, ui)
	{
		_.Sound.volume(ui.value);
	};
		
	Site.prototype.toggleMedia = function(forced)
	{
		if (typeof forced == "undefined")
		{
			forced = false;
		}
		
		if (forced)
		{
			this.$play.show();
			this.$pause.hide();
		}
		else
		{
			this.$play.toggle();
			this.$pause.toggle();
		}
	};
		
	Site.prototype.changeLang = function(lang)
	{
		var module = $('body').data('module');
		location.href = this.baseUrl + "home/lang/" + lang + "/" + module + "/"; 
	};
	
	Site.prototype.Fade = function(loader, message)
	{
		if (typeof loader == 'undefined')
			loader = true;
		if (typeof message == 'undefined')
			message = false;
		
		this.$fade.show();
		this.$fade.animate({opacity: 1}, 'middle');
		
		if (loader)
			$('#fade_loading').show();
		else
			$('#fade_loading').hide();

		if (message)
			$('#fade_message').show();
		else
			$('#fade_message').hide();
	};
	
	Site.prototype.FadeOut = function()
	{
		var me = this;
		this.$fade.animate({opacity: 0}, 'middle', function(){
			me.$fade.hide();
		});
	};
	
	_.Site = new Site;	
	return _.Site;
});
