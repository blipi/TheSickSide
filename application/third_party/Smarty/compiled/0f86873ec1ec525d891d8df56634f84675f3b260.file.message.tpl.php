<?php /* Smarty version Smarty-3.1.14, created on 2013-10-07 14:54:03
         compiled from "application\views\templates\message.tpl" */ ?>
<?php /*%%SmartyHeaderCode:64975252aeeb771918-89028818%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f86873ec1ec525d891d8df56634f84675f3b260' => 
    array (
      0 => 'application\\views\\templates\\message.tpl',
      1 => 1380672577,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '64975252aeeb771918-89028818',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'result' => 0,
    'header' => 0,
    'body' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5252aeeb794ad9_11013057',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5252aeeb794ad9_11013057')) {function content_5252aeeb794ad9_11013057($_smarty_tpl) {?><div class='message_<?php echo $_smarty_tpl->tpl_vars['result']->value;?>
' id='message'>
	<h3><?php echo $_smarty_tpl->tpl_vars['header']->value;?>
</h3>
	<?php echo $_smarty_tpl->tpl_vars['body']->value;?>

</div><?php }} ?>