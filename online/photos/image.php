<?php
session_start();
if (isset($_SESSION['id']) && isset($_GET['id']))
{
	require($_SERVER['DOCUMENT_ROOT'].'/../offline/dbconex.php');
	$sql = "SELECT data, thumbnail,name FROM data_photos where id='{$_GET['id']}' AND uid='{$_SESSION['id']}'";
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
			header("filename=\"{$picdata['name']}\"");
			if (isset($_GET['download'])){ header("Content-Disposition:attachment"); }
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