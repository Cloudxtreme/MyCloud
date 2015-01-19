<?php
$verify = TRUE;
require($_SERVER['DOCUMENT_ROOT'].'/../offline/start.php');
require('script.phpx');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/top.php');
?>
<?php if(isset($showeditor) && $showeditor){ ?>
	<a href="/documents" class="backlink">< Back to Documents</a>
	<span class="lastsaved"><? echo $saved; ?></span>
	<form method="POST">
		<input type="hidden" name="docid" value="<? echo $docid; ?>" />
		<input type="text" name="docname" id="docname" value="<? echo htmlspecialchars($docname); ?>" />
		<textarea id="elm1" class="tinymce" name="docdata" rows="15" cols="0" style="width: 80%">
			<? echo htmlspecialchars($editorcontent); ?>
		</textarea>
	</form>
<?php } elseif(isset($share) && $share) { ?>
	<a href="/documents" class="backlink">< Back to Documents</a>
	<span class="lastsaved"><? echo htmlspecialchars($docname); ?></span>
	<br><br>
	<form method="POST">
	<input type="hidden" name="share" value="1" />
	<input type="hidden" name="edit" value="<? echo $htmldocid; ?>" />
	<table border="0">
		<tr>
		<td class="sharetitle">Share this document</td>
		<td><input type="checkbox" name="sharecheckbox" <? echo $htmlchecked; ?> value="share" /></td>
		</tr>
		<tr>
		<td class="sharetitle">Share password</td>
		<td class="editbox"><input type="text" name="sharepassword" size="30" value="<? echo $htmlpass; ?>" autocomplete="off"  /></td>
		</tr>
		<tr>
		<td class="sharetitle">&nbsp</td>
		<td class="sharesubmit"><input type="submit" value="Save" /></td>
		</tr>
		</form>
		<?php
		if ($isshared){
			?>
		<form method="POST">
		<input type="hidden" name="share" value="1" />
		<input type="hidden" name="edit" value="<? echo $htmldocid; ?>" />
			<tr>
				<td class="sharetitle">URL</td>
				<td><? echo $htmlurl; ?></td>
			</tr>
				<td class="sharetitle emailtd">E-mail link</td>
				<td class="emailtd"><span class="editbox email"><input type="text" name="sendemail" size="30" value=""  /></span><span class="emailsend"><input type="submit" value="Send e-mail"  /></span><? echo $emailerror; ?></td>
			</tr>
		</form>
			<?php
		}
		?>
		
	</table>
<?php } else { 
header('location: /documents');
}
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottom.php');
?>