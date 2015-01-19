<?php
$verify = TRUE;
require($_SERVER['DOCUMENT_ROOT'].'/../offline/start.php');
require('script.phpx');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/top.php');
?>
<center>
	<div id="iconshome">
		<h2>Welcome to My Cloud <?php echo $user['fullname']; ?>!</h2>
		<a href="/music/artists"><img src="/images/musicicon.png" width="150" alt="" id="musiciconhome" /></a>
		<a href="/photos/albums"><img src="/images/photoicon.png" width="180" alt="" id="photoiconhome" /></a>
		<a href="/documents"><img src="/images/documenticon.png" width="150" alt="" id="documenticonhome" /></a>
		<br><br><h3>To get started click one of the icons above</h3>
	</div>
</center>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottom.php');
?>