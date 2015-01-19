<?php
$verify = TRUE;
require($_SERVER['DOCUMENT_ROOT'].'/../offline/toplogin.php');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/dbconex.php');
require('script.phpx');
?>
<script type="text/javascript">
$(document).ready(function() {
$('#logo').width('160px');
$('#logo').height('84px');
});
</script>
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
<? if (isset($imagedata)){ ?>
<div id="imagehead">
	<div id="imagetitle"><span class="imagebold"><? echo htmlentities($imagedata['name']); ?></span></div>
</div>
<div id="imageloading">
<h1>Loading image...</h1>
</div>
<img src="/photos/imagepublic.php?id=<? echo htmlentities($imageid); ?>&width=700"  style="display:none;" onload="imageload();resize_image('displayimage', 880);" id="displayimage" />
<div id="imagedesciption"><? echo $imagedata['description']; ?></div>

<? } else { echo $error; } ?>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottomlogin.php');
?>
