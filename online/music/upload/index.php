<?php
$verify = TRUE;
require($_SERVER['DOCUMENT_ROOT'].'/../offline/start.php');
require('script.phpx');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/top.php');
?>
<a href="/music" class="backlink">< Back to Music</a><br><br>
<form action="" method="post" enctype="multipart/form-data">
	<table border="0" class="uploadform">
		<tr><td class="uploadlabel">File</td><td><input type="file" name="uploaded_file"></td><td style="font-size:11px; color:#000;">(max 30MB)</td></tr>
		<tr><td>Song name</td><td><input type="text" name="songname" /></td></tr>
		<tr><td>Artist </td><td>
			<select name="artist">
				<option value="0"></option>
				<?php foreach($artists as $artist){
					if (isset($toselect) && $artist['id'] == $toselect) { $selected = ' selected="selected"'; } else { $selected = ''; }
					echo '<option value="'.$artist['id'].'"'.$selected.'>'.$artist['name'].'</option>'."\n";
					
				}
				?>
			</select>
		</td><td><a href="/music/artists" style="font-size:11px; color:#000;">(Create artist)</a></td></tr>
		<tr><td>Album</td><td><input type="text" name="album" /></td></tr>
		<tr><td>&nbsp</td><td><input type="submit" class="submit" value="Upload song"></td></tr>
		<tr><td>&nbsp</td><td><? if (isset($messageup)) { echo $messageup; } ?></td></tr>
	</table>
</form>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottom.php');
?>