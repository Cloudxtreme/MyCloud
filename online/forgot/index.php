<?php

$verify = TRUE;
require('script.phpx');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/toplogin.php');
?>
<?php if ($showform)
{ ?>
	<div class="center">
		<form method="POST">
			<table border="0">
				<tr><td><input type="text" value="E-mail address" name="email" onfocus="if(this.value=='E-mail address') this.value = ''; if(this.value=='') this.style.color = '#000000';" onblur="if(this.value=='') this.value='E-mail address'; if(this.value=='E-mail address') this.style.color = '#888888';" /></td></tr>
				<tr><td class="right"><input id="reset" type="submit" value="Reset password" /></td></tr>
			</table>
		</form>
	</div>
<? } else { ?>
	<div class="center long">
		<h3 class="reset">Your password has been reset and e-mailed to you, also your username has been included in the e-mail.<br><a href="/" class="back">Back to login</a></h3>
	</div>
<?php }
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottomlogin.php');
?>