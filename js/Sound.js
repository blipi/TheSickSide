var _ = _ || {};

define('Sound', ['Site'], function(){
	var Sound = function(){
		this.FFTSIZE = 64;      // number of samples for the analyser node FFT, min 32
		this.TICK_FREQ = 50;     // how often to run the tick function, in milliseconds

		this.Ready = false;
		this.canPlay = false;
		this.bars = false;
		
		this.sound = null;
		this.onPlay = null;
		this.onResume = null;
		this.onComplete = null;

		this.stopTick = false;
		this.dataset = 0;
		this.scale = 1;
		this.isFlash = false;
		this.animationDuration = 20;

		this.loaderWidth = 30;
		this.$loader = null;
		this.$display1 = null;
		this.$display2 = null;
	};
	
	Sound.prototype.initialize = function()
	{
		var me = this;
		
		d3.select("div#byte").selectAll("div")
	    .data([0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0])
	    .enter().append("div")
	    .attr("class", "sound_bar")
	    .style("height", 0);
	    
	    var i = 1;
	    $(".sound_bar").each(function(){
	    	var $e = $(this);
	    	var $p = $('<span class="sound_wrapper" id="sound_wrapper' + i + '" />').appendTo($e.parent());
	    	$e.detach().appendTo($p);
	    	i++;
	    });
	    
	    d3.select("div#byte2").selectAll("div")
	    .data([0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0])
	    .enter().append("div")
	    .attr("class", "sound2_bar")
	    .style("height", 0);

	    var i = 1;
	    $(".sound2_bar").each(function(){
	    	var $e = $(this);
	    	var $p = $('<span class="sound_wrapper" id="sound2_wrapper' + i + '" />').appendTo($e.parent());
	    	$e.detach().appendTo($p);
	    	i++;
	    });
	    
		soundManager.setup({
			url: _.Site.baseUrl + 'js/swf/',
			flashVersion: 9,
			preferFlash: true,
			
			onready: function() 
			{
		       	me.canPlay = true;
		       	me.Ready = true;
				me.isFlash = !soundManager.isHTML5 && !soundManager.is_iDevice;
				me.animationDuration = me.isFlash ? 200 : 20;
			},
			
			ontimeout: function() 
			{
			    me.Ready = true;
			},
		});
         
        this.$loader = $("#loader");        	
        this.$display1 = d3.select("div#byte").selectAll("div");
        this.$display2 = d3.select("div#byte2").selectAll("div");
        
        this.setScale(100);
	};
		
	Sound.prototype.addEvent = function(event, handler, scope)
	{   
		switch(event)
		{
			case "play":
				this.onPlay = handler;
				break;
			case "resume":
				this.onResume = handler;
				break;
			case  "complete":
				this.onComplete = handler;
				break;
		}
	};

	Sound.prototype.play = function(filename)
    {
		var me = this;
    	if (!this.canPlay)
		{
    		// Display no bars warning
        	alert("Su navegador no es compatible. Por favor actualicelo o use Google Chrome.");
        	return false;
		}
    	
		this.stopTick = false;
    	if (this.sound && this.sound.paused)
		{
    		this.sound.resume();
        	return true;
		}
    	
    	this.$loader.show();
    	this.sound = soundManager.createSound({
    		id: 'sound',
	      	url: filename,
	      	useEQData: true,
			
			onplay: function(){
				if (me.isFlash)
				{
					me.handlePlay();
				}
			},
			
			onresume: function(){
				me.onResume && me.onResume();
			},
			
			onfinish: function(){
				if (me.isFlash)
				{
					me.handleComplete();
				}
			},
			
			whieloading: function()
			{
				if (me.isFlash)
				{
					me.handleProgress({loaded: this.bytesLoaded, total: this.bytesTotal});
				}
			},

			whileplaying: function()
			{				
				me.freqByteData = this.eqData;
						
				if (me.isFlash)
					for(var k = 0; k < this.eqData.length; k++)
						me.freqByteData[k] = (+this.eqData.left[k] + +this.eqData.right[k]) * 125;

				me.changeBars();
			},
	    });

		if (!this.isFlash && this.sound._a && this.sound._a.addEventListener)
		{
			this.sound._a.addEventListener("progress", this.handleProgress);
			this.sound._a.addEventListener("play", this.handlePlay);
			this.sound._a.addEventListener("complete", this.handleComplete);
		}
		this.sound.play();
        
        return true;
    };
	    
    Sound.prototype.setScale = function(graphSize)
    {
    	this.scale = graphSize / 250;
    };
	    
    Sound.prototype.volume = function(value)
    {
    	try
    	{
    		this.sound.setVolume(value);
    	}
    	catch(err){}
    };
	    
    Sound.prototype.handleProgress = function(evt)
    {
    	if (evt.loaded instanceof XMLHttpRequestProgressEvent)
		{
    		evt.total = evt.loaded.total;
			evt.loaded = evt.loaded.loaded;
		}
		evt.progress = evt.loaded / evt.total;
		
		_.Sound.$loader.width(_.Sound.loaderWidth * evt.progress);
    };

    Sound.prototype.handlePlay = function(evt)
	{
		_.Sound.$loader.width(0);
		_.Sound.$loader.hide();
		_.Sound.onPlay && _.Sound.onPlay();
	},
		
	Sound.prototype.handleComplete = function()
	{
		_.Sound.playing = false;
		_.Sound.onComplete && _.Sound.onComplete();
	};
	    
	Sound.prototype.changeBars = function()
    {
		if (_.Sound.stopTick)
			return;
		
		_.Sound.$display1
		.data(_.Sound.freqByteData)
		.transition()
		.duration(_.Sound.animationDuration)
		.style("height", function(d) { 
			var v = Math.round(d) * _.Sound.scale;
			if(v < 0) {
				v = v * -1;
			}
			return v + "px"; 
		});
		  
		_.Sound.$display2
		.data(_.Sound.freqByteData)
		.transition()
		.duration(_.Sound.animationDuration)
		.style("height", function(d) { 
			var v = Math.round(d) * _.Sound.scale;
			if(v < 0) {
				v = v * -1;
			}
			return v + "px"; 
		});
    };

    Sound.prototype.stop = function()
    {
		if (this.sound)
		{
			this.stopTick = true;
			this.sound.stop();
		}
    };
    
    Sound.prototype.pause = function()
    {
    	if (_.Sound.sound && _.Sound.sound.playState == 1)
		{
			_.Sound.stopTick = true;
    		_.Sound.sound.pause();
	    	return true;
		}
    	return false;
    },
    
    Sound.prototype.animate = function(value)
    {
    	this.stopTick = value;
    };

    _.Sound = new Sound;
	return _.Sound;
});
