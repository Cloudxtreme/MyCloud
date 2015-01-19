<?php

$verify = TRUE;
require('script.phpx');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/toplogin.php');
?>
<?php if ($showform){ ?>
<script type="text/javascript">
$(document).ready(function() {
 if(document.getElementById('username').value=='Username') document.getElementById('username').style.color='#888';
 if(document.getElementById('fullname').value=='Full name') document.getElementById('fullname').style.color='#888';
 if(document.getElementById('email').value=='E-mail address') document.getElementById('email').style.color='#888';
});
</script>
<form method="POST">
	<input type="hidden" value="1" name="formsubmited" />
	<table border="0" cellspaceing="0" id="logintable">
		<tr><td class="welcome"><? echo $title ?></td></tr>
		<tr><td><input type="text" class="createinput" value="<? echo $inputusername; ?>" id="username" name="username" onload="" onfocus="if(this.value=='Username') this.value = ''; if(this.value=='') this.style.color = '#000000';" onblur="if(this.value=='') this.value='Username'; if(this.value=='Username') this.style.color = '#888888';" /></td></tr>
		<tr><td><input type="text" class="createinput" value="Password" name="password" id="password-clear" /><input type="password" value="" name="password" id="password-password" /></td></tr>
		<tr><td><input type="text" class="createinput" value="Password (Repeat)" id="password2-clear" /><input type="password" value="" name="password2" id="password2-password" /></td></tr>
		<tr><td><input type="text" class="createinput" value="<? echo $inputfullname; ?>" id="fullname" name="fullname" onfocus="if(this.value=='Full name') this.value = ''; if(this.value=='') this.style.color = '#000000';" onblur="if(this.value=='') this.value='Full name'; if(this.value=='Full name') this.style.color = '#888888';" /></td></tr>
		<tr><td><input type="text" class="createinput" value="<? echo $inputemail; ?>" id="email" name="email" onfocus="if(this.value=='E-mail address') this.value = ''; if(this.value=='') this.style.color = '#000000';" onblur="if(this.value=='') this.value='E-mail address'; if(this.value=='E-mail address') this.style.color = '#888888';" /></td></tr>
		<tr><td class="submit"><input type="submit" class="submit" value="Create my account!"</td></tr>
		<tr><td class="newaccount"><a href="/">Back to login</a></td></tr>
	</table>
</form>
<?php } else { ?>
<center>
	<h2>You have successfully created an account</h2>
	<a href="/"><h3>Login?</h3></a>
</center>
<?php } ?>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottomlogin.php');
?>