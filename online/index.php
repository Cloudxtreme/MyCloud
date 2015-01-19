<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../offline/library.php');
$verify = TRUE;
require('script.phpx');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/toplogin.php');
?>
<?php echo $logintop; ?>
	<table border="0" cellspaceing="0" id="logintable">
		<tr><td class="welcome"><? echo $title ?></td></tr>
		<tr><td><?php echo $login->input('username'); ?></td></tr>
		<tr><td><?php echo $login->input('passwordclear'); ?><?php echo $login->input('password'); ?></td></tr>		
		<tr><td class="submit"><?php echo $login->input('submit'); ?></td></tr>
		<tr><td class="newaccount"><a href="/createaccount">Create free account</a></td></tr>
	</table>
<?php echo $login->bottom(); ?>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottomlogin.php');
?>