<?php /* Smarty version Smarty-3.1.14, created on 2014-02-27 22:56:40
         compiled from "application\modules\news\templates\news.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3398530e6bdc02bfa1-29972472%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cdf53cabe76ec299356f3a43461fb0ceb98bff57' => 
    array (
      0 => 'application\\modules\\news\\templates\\news.tpl',
      1 => 1393538199,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3398530e6bdc02bfa1-29972472',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_530e6bdc04f8c6_03360294',
  'variables' => 
  array (
    'news' => 0,
    'news_item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_530e6bdc04f8c6_03360294')) {function content_530e6bdc04f8c6_03360294($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['news_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['news_item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['news']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['news_item']->key => $_smarty_tpl->tpl_vars['news_item']->value){
$_smarty_tpl->tpl_vars['news_item']->_loop = true;
?>
	<section>
		<h2><?php echo $_smarty_tpl->tpl_vars['news_item']->value->title;?>
</h2>
		<article>
			<?php echo $_smarty_tpl->tpl_vars['news_item']->value->text;?>

		</article>
	</section>
<?php } ?><?php }} ?>