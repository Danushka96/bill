<?php

define('EMAIL_FOR_REPORTS', 'dfdgdsfsd');
define('RECAPTCHA_PRIVATE_KEY', '@privatekey@');
define('FINISH_URI', 'index.php');
define('FINISH_ACTION', 'redirect');
define('FINISH_MESSAGE', 'Thanks for filling out my form!');
define('UPLOAD_ALLOWED_FILE_TYPES', 'doc, docx, xls, csv, txt, rtf, html, zip, jpg, jpeg, png, gif');

define('_DIR_', str_replace('\\', '/', dirname(__FILE__)) . '/');
require_once _DIR_ . '/handler.php';

?>

<?php if (frmd_message()): ?>
<link rel="stylesheet" href="<?php echo dirname($form_path); ?>/formoid-solid-blue.css" type="text/css" />
<span class="alert alert-success"><?php echo FINISH_MESSAGE; ?></span>
<?php else: ?>
<!-- Start Formoid form-->
<link rel="stylesheet" href="<?php echo dirname($form_path); ?>/formoid-solid-blue.css" type="text/css" />
<script type="text/javascript" src="<?php echo dirname($form_path); ?>/jquery.min.js"></script>
<form class="formoid-solid-blue" style="background-color:#ffffff;font-size:14px;font-family:'Roboto',Arial,Helvetica,sans-serif;color:#34495E;max-width:380px;min-width:150px" method="post"><div class="title"><h2>Login</h2></div>
	<div class="element-input<?php frmd_add_class("input"); ?>" title="Enter Your Username Here"><label class="title"><span class="required">*</span></label><div class="item-cont"><input class="large" type="text" name="input" required="required" placeholder="User Name"/><span class="icon-place"></span></div></div>
	<div class="element-password<?php frmd_add_class("password"); ?>" title="Enter Your Password Here"><label class="title"><span class="required">*</span></label><div class="item-cont"><input class="large" type="password" name="password" value="" required="required" placeholder="Password"/><span class="icon-place"></span></div></div>
<div class="submit"><input type="submit" value="Login"/></div></form><script type="text/javascript" src="<?php echo dirname($form_path); ?>/formoid-solid-blue.js"></script>

<!-- Stop Formoid form-->
<?php endif; ?>

<?php frmd_end_form(); ?>