<?php
if (!isset($_POST['secureen'])) 				{ exit(); }
if ($_POST['secureen'] != 'aoiewurfhbq2c9r8') 	{ exit(); }
require($_SERVER['DOCUMENT_ROOT'].'/../offline/dbconex.php');
$sql = "SELECT data,size FROM data_music where id='{$_POST['id']}' AND uid='{$_POST['uid']}'";
$result = mysqli_query($dblink, $sql);
$musicdata = mysqli_fetch_array($result);
echo $musicdata['data'];
?>