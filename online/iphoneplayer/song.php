<?php
require($_SERVER['DOCUMENT_ROOT'].'/../offline/start.php');
$file = 'http://10.0.0.16/music/readfile.php';
$fileid = $_GET['song'];
$fileidsql = mysqli_escape_string($dblink, $fileid);
$datetime = date("Y-m-d H:i:s");
mysqli_query($dblink, "UPDATE data_music SET lastplayed='$datetime' WHERE id='{$fileidsql}' AND uid='{$_SESSION['id']}'");
$result = mysqli_query($dblink, "SELECT size FROM data_music WHERE id='$fileidsql' AND uid='{$_SESSION['id']}'");
$size = mysqli_fetch_array($result);
$dbsize = $size['size'];

$params = array('http' => array(
              'method' => 'POST',
              'content' => 'id='.$fileid.'&uid='.$_SESSION['id'].'&secureen=aoiewurfhbq2c9r8'
            ));
$ctx = stream_context_create($params);
$fp = @fopen($file, 'rb', false, $ctx);

$usermusicdir = $_SERVER['DOCUMENT_ROOT'].'/tmpmusic/'.md5($_SESSION['id'].'laksjdfh');
$musicfilename = substr(md5($fileid.date('d')), 0, 10).'.mp3';
if (!is_dir($usermusicdir)){ mkdir($usermusicdir); }
if (!file_exists($usermusicdir.'/'.$musicfilename))
{
file_put_contents($usermusicdir.'/'.$musicfilename, stream_get_contents($fp));
}
$wwwfileurl = '/tmpmusic/'.md5($_SESSION['id'].'laksjdfh').'/'.$musicfilename;
header('location: '.$wwwfileurl);
?>