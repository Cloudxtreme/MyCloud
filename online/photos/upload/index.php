<?php
$verify = TRUE;
require($_SERVER['DOCUMENT_ROOT'].'/../offline/start.php');
require('script.phpx');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/top.php');
?>
<a href="<? echo $backlink; ?>" class="backlink">< Back to Photos</a><br><br>
<form action="" method="post" enctype="multipart/form-data">
	<table border="0" class="uploadform">
		<tr><td class="uploadlabel">File</td><td><input type="file" name="uploaded_file"></td><td style="font-size:11px; color:#000;">(max 30MB)</td></tr>
		<tr><td>photo name</td><td><input type="text" name="photoname" /></td></tr>
		<tr><td>album </td><td>
			<select name="album">
				<option value="0"></option>
				<?php foreach($albums as $album){
					if (isset($toselect) && $album['id'] == $toselect) { $selected = ' selected="selected"'; } else { $selected = ''; }
					echo '<option value="'.$album['id'].'"'.$selected.'>'.$album['name'].'</option>'."\n";
				} ?>
			</select>
		</td><td><a href="/photos/albums" style="font-size:11px; color:#000;">(Create album)</a></td></tr>
		<tr><td>Description</td><td><textarea name="description" style="width:234px;"></textarea></td></tr>
		<tr><td>&nbsp;</td><td><input type="submit" class="submit" value="Upload photo"></td></tr>
		<tr><td>&nbsp;</td><td><? if (isset($error)) { echo $error; } ?></td></tr>
	</table>
</form>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottom.php');
?>
