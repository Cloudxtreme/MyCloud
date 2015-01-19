<?php
$verify = TRUE;
require($_SERVER['DOCUMENT_ROOT'].'/../offline/start.php');
require('script.phpx');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/top.php');
if ($showartists){
?>
	<table id="docs" cellspaceing="0">
	<? if(isset($artists)){ ?>
		<tr>
			<td colspan="7"><form method="POST"><input type="submit" class="right" name="new" value="Create new artist"><input type="button" class="right" onclick="location.href='/music'" value="All songs"></form></td>
		</tr>

		<tr class="title">
		<td id="artistname" class="title top10">Artist name</td>
		<td class="songcount top10">Songs</td>
		<td></td>
		</tr>
<?php $i=0; foreach($artists as $artist){ ?>
<form method="POST">
	<input type="hidden" name="artist" value="<? echo $artist['id']; ?>" />
	<tr<? echo tblclass($i); ?> onclick="location.href='/music/?artist=<? echo $artist['id']; ?>'">
		<td id="artistname"><? echo $artist['name']; ?></td>
		<td class="docssize" style="text-align:left !important;"><? echo $artist['songs'] ?></td>
		<td class="button"><input type="submit" name="edit" value="Edit" /></td>
		<td class="button"><input type="submit" name="delete" value="Delete" /></td>
	</tr></a>
</form>
<? $i++;
} echo '</table>'; } else { ?>
<div style="float:left;">You have no artists!</div>
<div style="float:right;"><form method="POST"><input type="submit" class="right" name="new" value="Create new artist"><input type="button" class="right" onclick="location.href='/music'" value="All songs"></form></div>
</table>
<?php }} else { ?>
	<table border="0">
		<form method="POST">
			<input type="hidden" name="artist" value="<? echo $_POST['artist']; ?>" />
			<tr><td>artist name: </td></td><td><input type="text" name="artistname" value="<? echo $htmlartistname; ?>" /></td></tr>
			<tr><td>&nbsp;</td><td><input type="submit" style="float:right;" value="Save" /></td></tr>
		</form>
	</table>
<?php 
}
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottom.php');
?>
