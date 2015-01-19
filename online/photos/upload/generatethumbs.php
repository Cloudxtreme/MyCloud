<?php
include($_SERVER['DOCUMENT_ROOT'].'/../offline/dbconex.php');
include($_SERVER['DOCUMENT_ROOT'].'/../offline/smart_resize_image.function.php');
$result = mysqli_query($dblink, "SELECT * from data_photos");
while($image = mysqli_fetch_array($result))
{
	smart_resize_image($image['data'], '205', '0');
	$thumbnail = mysqli_escape_string($dblink, file_get_contents($file));
	unlink($file);
	$publicid = md5('1234erfghytrd£ç∂'.$image['id'].'q239uc^-=\'~~~dc%$#');
	mysqli_query($dblink, "UPDATE data_photos SET thumbnail='$thumbnail', publicid = '$publicid' WHERE id='{$image['id']}'");
	echo 'updated image '.$image['id'].'<br>';
}
?>