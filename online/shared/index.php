<?php
$verify = TRUE;
require('script.phpx');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/toplogin.php');
?>
<script type="text/javascript">
$(document).ready(function() {
$('#logo').width('160px');
$('#logo').height('84px');
});
</script>
<?php if(isset($documentname)) { ?>
	<span class="docname"><? echo htmlspecialchars($documentname); ?></span>
	<div id="documentdisplay">
		<? echo $documentdata; ?>
	</div>
<?php } elseif (isset($displaypass) && $displaypass) { ?>
	<form method="POST">
		<div id="publicdocpass">
			<div class="contain">
			<?php if(isset($passerror)){ echo $passerror; } else { echo '<br>'; } ?>
				<input type="text" value="Document password" id="password-clear" /><input type="password" value="" name="documentpassword" id="password-password" />
				<input type="submit" class="submit" value="Open document" />
			</div>
		</div>
	</form>
<?php } else {
echo $error;
}
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottomlogin.php');
?>