<?php

$verify = TRUE;
require($_SERVER['DOCUMENT_ROOT'].'/../offline/start.php');
require('script.phpx');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/top.php');
?>
<?php if(isset($photos)){
?>
<input type="button" class="right" onclick="location.href='upload<? if(isset($_GET['album'])){echo '?albumid='.$_GET['album'];}?>'" value="Upload new photo">
<input type="button" class="right" onclick="location.href='albums'" value="Albums"><br><br>
<div id="photoscontainer">
<?php foreach($photos as $imagedata){ ?>
	<div class="img">
	  <a href="/photos/viewer/?imageid=<? echo urlencode($imagedata['id']); ?>">
	  <img src="/photos/image.php?id=<? echo htmlentities($imagedata['id']); ?>&thumbnail=1" alt="<? echo htmlentities($imagedata['name']); ?>" />
	  </a>
	  <div class="desc"><? echo htmlentities($imagedata['name']); ?></div>
	</div>
<? } ?>
</div>
<? } else { ?>
<input type="button" class="right" onclick="location.href='upload<? if(isset($_GET['album'])){echo '?albumid='.$_GET['album'];}?>'" value="Upload new photo">
<input type="button" class="right" onclick="location.href='albums'" value="Albums">
You have no photos<? if(isset($_GET['album'])) { echo ' in that album'; } ?>!
<?php }
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottom.php');
?>
