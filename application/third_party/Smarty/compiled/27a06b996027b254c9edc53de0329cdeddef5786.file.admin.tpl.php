<?php /* Smarty version Smarty-3.1.14, created on 2014-03-10 00:41:37
         compiled from "application\modules\admin\templates\admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24708530fbaa2ef2717-14476193%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '27a06b996027b254c9edc53de0329cdeddef5786' => 
    array (
      0 => 'application\\modules\\admin\\templates\\admin.tpl',
      1 => 1394408435,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24708530fbaa2ef2717-14476193',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_530fbaa2f0c923_29093513',
  'variables' => 
  array (
    'hidden_name' => 0,
    'hidden_value' => 0,
    'current_language' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_530fbaa2f0c923_29093513')) {function content_530fbaa2f0c923_29093513($_smarty_tpl) {?><div id="admin_zone">
	<input type="hidden" id="hidden_post" name="<?php echo $_smarty_tpl->tpl_vars['hidden_name']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['hidden_value']->value;?>
" />
	
	<div id="admin_links">
		<div id="admin_links_header">Administració</div>
		<div id="admin_link"><a href="javascript:void(0);" onclick="_.Admin.show('admin_news_new');">Notícies</a></div>
		<div id="admin_link"><a href="javascript:void(0);" onclick="_.Admin.show('admin_file_upload');">Arxius</a></div>
		
		<br />
		<div id="admin_links_header">Pàgines</div>
	</div>
	
	<div id="admin_content">
		<div id="admin_general" style="">
			<div id="admin_conent_header">General</div>
			
			<div id="admin_content_wrapper">
				Benvingut a la zona administrativa.
				<br />
				Des del panel esquerra pot accedir a la configuració del lloc.
				<br />
				<br />
				Sort!
			</div>
		</div>
		
		<div id="admin_news_new" style="display:none;">
			<div id="admin_conent_header">Nova noticia</div>
			
			<div id="admin_content_wrapper">
				<h2>Titol:</h2> <input type="text" name="title" id="news_title" />
				<select id="news_language" onchange="_.Admin.addTranslation($(this).val());">
					<option value="cat" <?php if ($_smarty_tpl->tpl_vars['current_language']->value=="cat"){?>selected<?php }?>>Català</option>
					<option value="esp" <?php if ($_smarty_tpl->tpl_vars['current_language']->value=="esp"){?>selected<?php }?>>Castellano</option>
					<option value="eng" <?php if ($_smarty_tpl->tpl_vars['current_language']->value=="eng"){?>selected<?php }?>>English</option>				
				</select>
				<br />
				<h2>Text:</h2>
				<textarea></textarea>		 
			 	<br />
			 	<div id="news_send_wrapper">
			 		<input type="button" value="Enviar" id="news_send" onclick="_.Admin.sendNews();" />
			 	</div>
			</div>
		</div>
		
		<div id="admin_file_upload" style="display:none;"> 
			<div id="admin_conent_header">Pujar arxius</div>
			
			<div id="admin_content_wrapper">
				<div id="container">
				    <a id="pickfiles" href="javascript:;">Selecionar arxius</a>
				    <a id="uploadfiles" href="javascript:;">Pujar arxius</a>
				    
				    <div id="filelist">El teu navegador no suporta la pujada de fitxers.</div>
					
				</div>
			</div>
			
			<div id="admin_content_wrapper">
				<div id="console"></div>
			</div>
		</div>
	</div>
	
	<div style="clear: both"></div>
	
</div><?php }} ?>