<?php

$verify = TRUE;
require($_SERVER['DOCUMENT_ROOT'].'/../offline/start.php');
require('script.phpx');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/top.php');
?>
<? if (isset($showedit) && $showedit) { ?>
<a href="/photos" class="backlink">< Back to photos</a><br><br>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" value="<? echo $photodata['id']; ?>" name="photo" />
<input type="hidden" value="1" name="edit" />
	<table border="0" class="uploadform">
		<tr><td style="min-width:130px;">Photo name</td><td><input type="text" value="<? echo htmlentities($photodata['name']); ?>" name="photoname" /></td></tr>
		<tr><td>Album </td><td>
			<select name="album">
				<option value="0"></option>
				<?php foreach($albums as $album){
				if ($album['id'] == $photodata['album']) { $selectedhtml = ' selected="selected"'; } else { $selectedhtml = ''; }
				echo '<option value="'.$album['id'].'"'.$selectedhtml.'>'.$album['name'].'</option>'."\n"; } ?>
			</select>
		</td><td><a href="/photos/albums" style="font-size:11px; color:#000;">(Create album)</a></td></tr>
		<tr><td>Description</td><td><textarea name="description" style="width:234px;"><? echo $photodata['description'] ?></textarea></td></tr>
		</form>
		<tr><td></td><td><input type="submit" class="submit" value="Save changes"></td></tr>
		<tr><td>Photo size</td><td colspan="10"><? echo htmlentities(formatbytes($photodata['size'])); ?></td></tr>
		</table>
		<table border="0" class="uploadform">
		<tr><td style="min-width:130px;">Photo private URL</td><td colspan="10">http://mycloud.jyelewis.com/photos/image.php?id=<? echo htmlentities($photodata['id']); ?></td></tr>
		<tr><td>Photo public URL</td><td colspan="20">http://mycloud.jyelewis.com/photos/imagepublic.php?id=<? echo htmlentities($photodata['publicid']); ?></td></tr>
		<tr><td>Photo public share</td><td colspan="20">http://mycloud.jyelewis.com/photos/public/?photoid=<? echo htmlentities($photodata['publicid']); ?></td></tr>
		<tr><td>&nbsp</td></tr>
		<tr><td>&nbsp</td><td><form method="POST">
				<input type="hidden" value="<? echo $photodata['id']; ?>" name="photo" />
				<input type="hidden" value="1" name="delete" />
				<input type="submit" value="Delete photo"  style="width:240px; !important;" />
				</form>
		</td></tr>
	</table>
</form>
<?php
} else { if (isset($_SERVER['HTTP_REFERER'])){ $backlink = $_SERVER['HTTP_REFERER']; } else { $backlink = '/photos'; } header('location: '.$backlink); }
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottom.php');
?>
