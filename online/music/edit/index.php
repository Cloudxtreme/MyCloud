<?php

$verify = TRUE;
require($_SERVER['DOCUMENT_ROOT'].'/../offline/start.php');
require('script.phpx');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/top.php');
?>
<? if (isset($showedit) && $showedit) { ?>
<a href="/music" class="backlink">< Back to Music</a><br><br>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" value="<? echo $songdata['id']; ?>" name="song" />
<input type="hidden" value="1" name="edit" />
	<table border="0" class="uploadform">
		<tr><td>Song name</td><td><input type="text" value="<? echo htmlentities($songdata['name']); ?>" name="songname" /></td></tr>
		<tr><td>Artist </td><td>
			<select name="artist">
				<option value="0"></option>
				<?php foreach($artists as $artist){
				if ($artist['id'] == $songdata['artist']) { $selectedhtml = ' selected="selected"'; } else { $selectedhtml = ''; }
				echo '<option value="'.$artist['id'].'"'.$selectedhtml.'>'.$artist['name'].'</option>'."\n"; } ?>
			</select>
		</td><td><a href="/music/artists" style="font-size:11px; color:#000;">(Create artist)</a></td></tr>
		<tr><td>Album</td><td><input type="text" value="<? echo htmlentities($songdata['album']); ?>" name="album" /></td></tr>
		</form>
		<tr><td></td><td><input type="submit" class="submit" value="Save changes"></td></tr>
		<tr><td>&nbsp</td></tr>
		<tr><td>&nbsp</td><td><form method="POST">
				<input type="hidden" value="<? echo $songdata['id']; ?>" name="song" />
				<input type="hidden" value="1" name="delete" />
				<input type="submit" value="Delete song" />
				</form>
		</td></tr>
		<tr><td>&nbsp</td><td><a href="/music/song.php?song=<? echo $songdata['id']; ?>" class="blacklink">Download song</a></td></tr>
	</table>
</form>
<?php
} else { header('location: /music'); }
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottom.php');
?>
