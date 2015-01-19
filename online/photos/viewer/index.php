<?php

$verify = TRUE;
require($_SERVER['DOCUMENT_ROOT'].'/../offline/start.php');
require('script.phpx');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/top.php');
if ($showimage){
?>
<script type="text/javascript">
	function resize_image(image, w, h) {
    if (typeof(image) != 'object') image = document.getElementById(image);
    if (w == null || w == undefined)
        w = (h / image.clientHeight) * image.clientWidth;
    if (h == null || h == undefined)
        h = (w / image.clientWidth) * image.clientHeight;
    image.style['height'] = h + 'px';
    image.style['width'] = w + 'px';
    return;
}
	function imageload()
{
	document.getElementById('imageloading').style.display = 'none';
	document.getElementById('displayimage').style.display = 'block';
	document.getElementById('imagedesciption').style.display = 'block';
}

</script>
<div id="imagehead">
	<div id="imagetitle"><span class="imagebold"><? echo htmlentities($imagedata['htmlname']); ?></span></div>
	<a href="<? echo $backlink; ?>" class="backimages">< Back to Photos</a>
	<div id="imageedit"><a href="/photos/edit/?edit=<? echo htmlentities($imagedata['id']); ?>">Edit</a> - <a href="/photos/image.php?id=<? echo htmlentities($imagedata['id']); ?>">View full size</a> - <a href="/photos/image.php?id=<? echo htmlentities($imagedata['id']); ?>&download=1">Download</a></div>
</div>
<div id="imageloading">
<h1>Loading image...</h1>
</div>
<img src="/photos/image.php?id=<? echo htmlentities($imagedata['id']); ?>&width=700"  style="display:none;" onload="imageload();resize_image('displayimage', 880);" id="displayimage" />
<div id="imagedesciption"><? echo $imagedata['description']; ?></div>

<? } ?>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottom.php');
?>
