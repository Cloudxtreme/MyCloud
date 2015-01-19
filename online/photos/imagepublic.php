<?php
session_start();
if (isset($_GET['id']))
{
	require($_SERVER['DOCUMENT_ROOT'].'/../offline/dbconex.php');
	$imageid = mysqli_escape_string($dblink, $_GET['id']);
	$sql = "SELECT data, thumbnail FROM data_photos where publicid='{$imageid}'";
	$result = mysqli_query($dblink, $sql);
	if (mysqli_num_rows($result) > 0)
	{
		$picdata = mysqli_fetch_array($result);
		if (isset($_GET['thumbnail']))
		{
			header('content-type: image/jpeg');
			echo $picdata['thumbnail'];
		} elseif (isset($_GET['width'])) {
			require($_SERVER['DOCUMENT_ROOT'].'/../offline/smart_resize_image.function.php');
			smart_resize_image($picdata['data'], $_GET['width'], '0');
			header('content-type: image/jpeg');
			echo file_get_contents($file);
			unlink($file);
		} else {
			header('content-type:image/jpeg');
			echo $picdata['data'];
		}
	} else {
		header('content-type:image/png');
		readfile($_SERVER['DOCUMENT_ROOT'].'/../offline/noimage.png');
	}
} else {
	header('content-type:image/png');
	readfile($_SERVER['DOCUMENT_ROOT'].'/../offline/noimage.png');
}
?>