<?php

$verify = TRUE;
require($_SERVER['DOCUMENT_ROOT'].'/../offline/start.php');
require('script.phpx');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/top.php');
?>
<table border="0" class="center long">
	<form method="POST">
	<tr>
		<td class="admintitle">Username</td>
		<td><input type="text" value="<? echo $htmluser; ?>" name="user" /><input type="submit" value="Look up" /><? echo $error; ?></td>
	</tr>
	</form>
	<?php if (isset($showall)){ ?>
		<tr>
			<td class="admintitle adminspace">&nbsp</td>
			<td class="adminspace"><? echo $htmlname; ?></td>
		</tr>
		
		<tr>
			<td class="admintitle">Data allowed</td>
			<td><? echo formatbytes($htmlspace); ?></td>
		</tr>
		
		<tr>
			<td class="admintitle">Data used</td>
			<td><? echo formatbytes($htmlused); ?></td>
		</tr>
		
		<form method="POST">
		<input type="hidden" name="user" value="<? echo $htmluser; ?>" />
		<tr>
			<td class="admintitle adminspace">Change space</td>
			<td class="adminspace"><input type="text" size="3" max="4" name="changespace" />MB <input type="submit" value="Change space" /></td>
		</tr>
		</form>
		<form method="POST">
		<input type="hidden" name="user" value="<? echo $htmluser; ?>" />
		<tr>
			<td class="admintitle">Add space</td>
			<td class=""><input type="text" size="3" max="4" name="addspace" />MB <input type="submit" value="Add space" /></td>
		</tr>
	</form>
<? } ?>
</table>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottom.php');
?>