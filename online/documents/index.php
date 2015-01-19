<?php
$verify = TRUE;
require($_SERVER['DOCUMENT_ROOT'].'/../offline/start.php');
require('script.phpx');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/top.php');
?>
<?php if ($showdocs){ if(isset($docs)){ ?>
	<table id="docs" cellspaceing="0">
		<tr>
			<td colspan="8">
				<form method="POST" action="open/">
					<input type="submit" id="createdoc" name="createdoc" value="Create new document" />
				</form>
				<?php echo $searchformcode; ?>
			</td>
		</tr>
		<tr class="title">
		
		<td id="name"><a class="blacklink" href="?docorder=name">Document name</a></td>
		<td class="date"><a class="blacklink" href="?docorder=edited">Last saved</a></td>
		<td class="date"><a class="blacklink" href="?docorder=opened">Last opened</a></td>
		<td class="date"><a class="blacklink" href="?docorder=created">Created</a></td>
		<td class="size"><a class="blacklink" href="?docorder=size">Size</a></td>
		<td></td>
		</tr>
<?php $i=0; foreach($docs as $doc){ ?>
<form method="POST" action="open/">
	<input type="hidden" name="edit" value="<? echo $doc['id']; ?>" />
	<input type="hidden" name="doc" value="<? echo $doc['id']; ?>" />
	<tr<?php echo tblclass($i); ?>>
		<td id="name"><? echo $doc['name']; ?></td>
		<td class="docsdate"><? echo dategen($doc['edited']); ?></td>
		<td class="docsdate"><? echo dategen($doc['opened']); ?></td>
		<td class="docsdate"><? echo dategen($doc['created']); ?></td>
		<td class="docssize"><? echo formatBytes($doc['size']); ?></td>
		<td class="button first"><input type="submit" name="Open" value="Open" /></td>
		<td class="button"><input type="submit" name="share" value="Share" /></td>
		<td class="button"><input type="submit" name="delete" value="Delete" /></td>
	</tr>
</form>
<? $i++; } echo '</table>'; } else { ?>
<form method="POST" action="open/">
<input type="submit" id="createdoc" name="createdoc" value="Create document" />
</form>
You have no documents!
<?php echo $searchformcode; ?>
<?php
} } ?>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottom.php');
?>