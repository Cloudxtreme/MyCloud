<?php
require($_SERVER['DOCUMENT_ROOT'].'/../offline/start.php');
mempage($lastpageold);
$fileid = $_GET['song'];
$fileidsql = mysqli_escape_string($dblink, $fileid);
$sql = "SELECT data,size FROM data_music where id='{$fileidsql}' AND uid='{$_SESSION['id']}'";
$result = mysqli_query($dblink, $sql);
$musicdata = mysqli_fetch_array($result);
$musicdata = $musicdata['data'];

$datetime = date("Y-m-d H:i:s");
mysqli_query($dblink, "UPDATE data_music SET lastplayed='$datetime' WHERE id='{$fileidsql}' AND uid='{$_SESSION['id']}'");
$result = mysqli_query($dblink, "SELECT size FROM data_music WHERE id='$fileidsql' AND uid='{$_SESSION['id']}'");
$size = mysqli_fetch_array($result);
$dbsize = $size['size'];

$usermusicdir = $_SERVER['DOCUMENT_ROOT'].'/tmpmusic/'.md5($_SESSION['id'].'laksjdfh');
$musicfilename = substr(md5($fileid.date('d')), 0, 10).'.mp3';
if (!is_dir($usermusicdir)){ mkdir($usermusicdir); }
if (!file_exists($usermusicdir.'/'.$musicfilename))
{
	file_put_contents($usermusicdir.'/'.$musicfilename, $musicdata);
}
$wwwfileurl = '/tmpmusic/'.md5($_SESSION['id'].'laksjdfh').'/'.$musicfilename;
header('location: '.$wwwfileurl);
?>
