<?php /* Smarty version Smarty-3.1.14, created on 2014-05-20 18:57:13
         compiled from "application\views\templates\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:64255252ac8009d729-45680374%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '495fc432b3fd34d1f582d189e758c35b360a4790' => 
    array (
      0 => 'application\\views\\templates\\header.tpl',
      1 => 1400605020,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '64255252ac8009d729-45680374',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5252ac800dd861_79696037',
  'variables' => 
  array (
    'title' => 0,
    'base_url' => 0,
    'css' => 0,
    'style' => 0,
    'js' => 0,
    'script' => 0,
    'canonical' => 0,
    'current_language' => 0,
    'current_module' => 0,
    'redirects' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5252ac800dd861_79696037')) {function content_5252ac800dd861_79696037($_smarty_tpl) {?><!DOCTYPE html>

<html>
	<head>
		<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
		<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
js/jquery.js"></script>
		<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
js/jquery.lettering.js"></script>
		<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
js/jquery.reject.js"></script>
		<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
js/jquery-ui-1.10.3.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
js/modernizr.custom.js"></script>
		<script type="text/javascript" data-main="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
js/"  src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
js/require.js"></script>
		<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
js/libs/soundmanager2.js"></script>		
		<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
js/libs/d3.v3.min.js"></script>
		
		<script type="text/javascript">
			var BasicLibraries = ['Site', 'Sound', 'Menu', 'Router'];
			require(BasicLibraries, function(){
				for (var i = 0; i < BasicLibraries.length; i++)
				{
					arguments[i].initialize();
				}
			});
		</script>
		
		<link href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
style/stylesheets/screen.css" media="screen, projection" rel="stylesheet" type="text/css" />

		<!--[if lte IE 8]>
			<link href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
style/stylesheets/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
			<link href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
style/stylesheets/jreject.css" media="screen, projection" rel="stylesheet" type="text/css" />
		<![endif]-->
		
		
		<?php  $_smarty_tpl->tpl_vars['style'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['style']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['css']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['style']->key => $_smarty_tpl->tpl_vars['style']->value){
$_smarty_tpl->tpl_vars['style']->_loop = true;
?>
		<link href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
style/stylesheets/<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
.css" rel="stylesheet" type="text/css" />
		<?php } ?>
		
		<?php if (count($_smarty_tpl->tpl_vars['js']->value)>0){?>
		<script type="text/javascript">
			require([<?php  $_smarty_tpl->tpl_vars['script'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['script']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['js']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['script']->key => $_smarty_tpl->tpl_vars['script']->value){
$_smarty_tpl->tpl_vars['script']->_loop = true;
?>'<?php echo $_smarty_tpl->tpl_vars['script']->value;?>
',<?php } ?>], function(){
				var n = <?php echo count($_smarty_tpl->tpl_vars['js']->value);?>
;
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
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['canonical']->value!=''){?>
		<link rel="canonical" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['canonical']->value;?>
"/>
		<?php }?>
	</head>

	<body data-baseurl="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
" data-language="<?php echo $_smarty_tpl->tpl_vars['current_language']->value;?>
" data-module="<?php echo $_smarty_tpl->tpl_vars['current_module']->value;?>
" >
		
		<div id="header_background"></div>
		<div id="header_album"><img src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
style/images/inlay_exterior.png" /></div>
		
		<div id='languageBar'>
			<img src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
style/images/cat.png" onclick="_.Site.changeLang('cat');" alt="Català" />
			<img src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
style/images/eses.png" onclick="_.Site.changeLang('esp');" alt="Castellano" />
			<img src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
style/images/en.png" onclick="_.Site.changeLang('eng');" alt="English" />
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
				<div class="menu_item menu_news"><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['redirects']->value['news'];?>
/"><?php echo lang('menu_news');?>
</a></div>
				<div class="menu_item menu_concerts"><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['redirects']->value['concerts'];?>
/"><?php echo lang('menu_tours');?>
</a></div>
				<div class="menu_item menu_discography"><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['redirects']->value['discography'];?>
/"><?php echo lang('menu_discography');?>
</a></div>
				
				<div class="menu_item menu_media"><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['redirects']->value['media'];?>
/"><?php echo lang('menu_media');?>
</a></div>
				<div class="menu_item menu_biography"><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['redirects']->value['biography'];?>
/"><?php echo lang('menu_biography');?>
</a></div>
				<div class="menu_item menu_contact" ><a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['redirects']->value['contact'];?>
/"><?php echo lang('menu_contact_us');?>
</a></div>
			</div>
			
			<div id="logo">	
				<img id="vinyl" src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
style/images/vinyl.png" alt="The Sick Side" />
				<img id="sublogo" src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
style/images/BornToKill.png" alt="The Sick Side - Born To Kill" />
			</div>
		</div>
		
		<div id="content">
<?php }} ?>