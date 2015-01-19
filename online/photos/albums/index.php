<?php

$verify = TRUE;
require($_SERVER['DOCUMENT_ROOT'].'/../offline/start.php');
require('script.phpx');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/top.php');
if ($showalbums){
?>
	<table id="docs" cellspaceing="0">
	<? if(isset($albums)){ ?>
		<tr>
			<td colspan="7"><form method="POST"><input type="submit" class="right" name="new" value="Create new album"><input type="button" class="right" onclick="location.href='/photos'" value="All photos"></form></td>
		</tr>

		<tr class="title">
		<td id="artistname" class="title top10">Album name</td>
		<td class="songcount top10">Pictures</td>
		<td></td>
		</tr>
<?php $i=0; foreach($albums as $album){ ?>
<form method="POST">
	<input type="hidden" name="album" value="<? echo $album['id']; ?>" />
	<tr<? echo tblclass($i); ?> onclick="location.href='/photos/?album=<? echo $album['id']; ?>'">
		<td id="artistname"><? echo $album['name']; ?></td>
		<td class="docssize" style="text-align:left !important;"><? echo $album['photos'] ?></td>
		<td class="button"><input type="submit" name="edit" value="Edit" /></td>
		<td class="button"><input type="submit" name="delete" value="Delete" /></td>
	</tr></a>
</form>
<? $i++;
} echo '</table>'; } else { ?>
<div style="float:left;">You have no albums!</div>
<div style="float:right;"><form method="POST"><input type="submit" class="right" name="new" value="Create new album"><input type="button" class="right" onclick="location.href='/photos'" value="All photos"></form></div>
</table>
<?php }} else { ?>
	<table border="0">
		<form method="POST">
			<input type="hidden" name="album" value="<? echo $_POST['album']; ?>" />
			<tr><td>Album name: </td></td><td><input type="text" name="albumname" value="<? echo $htmlalbumname; ?>" /></td></tr>
			<tr><td>&nbsp;</td><td><input type="submit" style="float:right;" value="Save" /></td></tr>
		</form>
	</table>
<?php 
}
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottom.php');
?>
