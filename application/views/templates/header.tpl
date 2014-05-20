<!DOCTYPE html>

<html>
	<head>
		<title>{$title}</title>
		<script type="text/javascript" src="{$base_url}js/jquery.js"></script>
		<script type="text/javascript" src="{$base_url}js/jquery.lettering.js"></script>
		<script type="text/javascript" src="{$base_url}js/jquery.reject.js"></script>
		<script type="text/javascript" src="{$base_url}js/jquery-ui-1.10.3.custom.min.js"></script>
		<script type="text/javascript" src="{$base_url}js/modernizr.custom.js"></script>
		<script type="text/javascript" data-main="{$base_url}js/"  src="{$base_url}js/require.js"></script>
		<script type="text/javascript" src="{$base_url}js/libs/soundmanager2.js"></script>		
		<script type="text/javascript" src="{$base_url}js/libs/d3.v3.min.js"></script>
		
		<script type="text/javascript">
			var BasicLibraries = ['Site', 'Sound', 'Menu', 'Router'];
			require(BasicLibraries, function(){
				for (var i = 0; i < BasicLibraries.length; i++)
				{
					arguments[i].initialize();
				}
			});
		</script>
		
		<link href="{$base_url}style/stylesheets/screen.css" media="screen, projection" rel="stylesheet" type="text/css" />

		<!--[if lte IE 8]>
			<link href="{$base_url}style/stylesheets/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
			<link href="{$base_url}style/stylesheets/jreject.css" media="screen, projection" rel="stylesheet" type="text/css" />
		<![endif]-->
		
		
		{foreach from=$css item=style}
		<link href="{$base_url}style/stylesheets/{$style}.css" rel="stylesheet" type="text/css" />
		{/foreach}
		
		{if count($js) > 0}
		<script type="text/javascript">
			require([{foreach from=$js item=script}'{$script}',{/foreach}], function(){
				var n = {count($js)};
				var i = 0;
				for (; i < n; i++)
				{
					var obj = arguments[i];
					if (typeof obj != "undefined")
					{
						if ('initialize' in obj)
						{
							obj.initialize();
						}
					}
				}
			});
		</script>
		{/if}

		{if $canonical != ''}
		<link rel="canonical" href="{$base_url}{$canonical}"/>
		{/if}
	</head>

	<body data-baseurl="{$base_url}" data-language="{$current_language}" data-module="{$current_module}" >
		
		<div id="header_background"></div>
		<div id="header_album"><img src="{$base_url}style/images/inlay_exterior.png" /></div>
		
		<div id='languageBar'>
			<img src="{$base_url}style/images/cat.png" onclick="_.Site.changeLang('cat');" alt="Català" />
			<img src="{$base_url}style/images/eses.png" onclick="_.Site.changeLang('esp');" alt="Castellano" />
			<img src="{$base_url}style/images/en.png" onclick="_.Site.changeLang('eng');" alt="English" />
		</div>
		
		<div id="menu_line">
			<div class="media_player">
				<div id="play" onclick="_.Site.playSound();"></div>
				<div id="loader" onclick="_.Site.playSound();"></div>
				<div id="pause" onclick="_.Site.pauseSound();"></div>
				<div id="stop" onclick="_.Site.stopSound();"></div>
				
				<div id="slider"></div>
			</div>	
		</div>
		
		<div id="outer_border">
			<div id="inner_circle">		
				<div id="inner_border">
					<span id="name_header">The Sick</span>
					<span id="name_footer">Side</span>
				</div>
			</div>
		
			<div id="byte" class="graph"></div>
			<div id="byte2" class="graph"></div>
			
			<div id="menu">
				<div class="menu_item menu_news"><a href="{$base_url}{$redirects['news']}/">{lang('menu_news')}</a></div>
				<div class="menu_item menu_concerts"><a href="{$base_url}{$redirects['concerts']}/">{lang('menu_tours')}</a></div>
				<div class="menu_item menu_discography"><a href="{$base_url}{$redirects['discography']}/">{lang('menu_discography')}</a></div>
				
				<div class="menu_item menu_media"><a href="{$base_url}{$redirects['media']}/">{lang('menu_media')}</a></div>
				<div class="menu_item menu_biography"><a href="{$base_url}{$redirects['biography']}/">{lang('menu_biography')}</a></div>
				<div class="menu_item menu_contact" ><a href="{$base_url}{$redirects['contact']}/">{lang('menu_contact_us')}</a></div>
			</div>
			
			<div id="logo">	
				<img id="vinyl" src="{$base_url}style/images/vinyl.png" alt="The Sick Side" />
				<img id="sublogo" src="{$base_url}style/images/BornToKill.png" alt="The Sick Side - Born To Kill" />
			</div>
		</div>
		
		<div id="content">
