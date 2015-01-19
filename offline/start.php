<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../offline/library.php');
@session_start();
if (!isset($config['bypassvalidation'])) { $config['bypassvalidation'] = FALSE; }
if (!isset($_SESSION['id']) && !$config['bypassvalidation']) { header('location:/'); exit(); }
require($_SERVER['DOCUMENT_ROOT'].'/../offline/dbconex.php');
if (isset($_SESSION['id']) && !$config['bypassvalidation']) {
	$sql = "SELECT * FROM users WHERE id='{$_SESSION['id']}'";
	$result = mysqli_query($dblink, $sql);
	$user = mysqli_fetch_array($result);
}

function formatBytes($size, $precision = 2)
{
	if ($size == 0) { return '0B'; }
    $base = log($size) / log(1024);
    $suffixes = array('B', 'k', 'MB', 'GB', 'TB');   

    return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
}
function mempage($url)
{
global $dblink;
$url = mysqli_escape_string($dblink, $url);
$sql = "UPDATE users SET lastpage='$url' WHERE id='{$_SESSION['id']}'";
if (mysqli_query($dblink, $sql)){ return TRUE; } else { return FALSE; }
}
function calculatedata() {
	global $datausage, $dblink, $user;
	$sql = "SELECT size FROM data_documents WHERE uid='{$_SESSION['id']}'";
	$result = mysqli_query($dblink, $sql);
	$totalsize = 0;
	while ($size = mysqli_fetch_array($result))
	{
		$totalsize = $totalsize+$size['size'];
	}
	$totalsizedocs = $totalsize;
	
	$sql = "SELECT size FROM data_music WHERE uid='{$_SESSION['id']}'";
	$result = mysqli_query($dblink, $sql);
	$totalsizemusic = 0;
	while ($size = mysqli_fetch_array($result))
	{
		$totalsize = $totalsize+$size['size'];
		$totalsizemusic = $totalsizemusic+$size['size'];
	}
	
	$sql = "SELECT size FROM data_photos WHERE uid='{$_SESSION['id']}'";
	$result = mysqli_query($dblink, $sql);
	$totalsizepics = 0;
	while ($size = mysqli_fetch_array($result))
	{
		$totalsize = $totalsize+$size['size'];
		$totalsizepics = $totalsizepics+$size['size'];
	}

	$datausage['documents'] = $totalsizedocs;
	$datausage['pictures'] = $totalsizepics;
	$datausage['music'] = $totalsizemusic;

	$datausage['used'] = $totalsize;
	$datausage['allowed'] = $user['dalowed'];
	$datausage['remaining'] = $user['dalowed']-$totalsize;
	$division = $datausage['allowed']/100;
	$datausage['percent'] = $datausage['used']/$division;
}
$lastpage = mysqli_fetch_array(mysqli_query($dblink, "SELECT lastpage FROM users WHERE id='{$_SESSION['id']}'"));
$lastpageold = $lastpage['lastpage'];
calculatedata();
mempage($_SERVER["REQUEST_URI"]);
?>