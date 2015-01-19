<?php
$verify = TRUE;
require('script.phpx');
if ($logedin)
{
	require($_SERVER['DOCUMENT_ROOT'].'/../offline/start.php');
	require($_SERVER['DOCUMENT_ROOT'].'/../offline/top.php');
} else {
	require($_SERVER['DOCUMENT_ROOT'].'/../offline/toplogin.php');
	?>
		<script type="text/javascript">
			$(document).ready(function() {
			$('#logo').width('160px');
			$('#logo').height('84px');
			});
		</script>
	<?php
}
?>
<div id="aboutdiv">
	<h2 class="center" style="text-align:right;">My Cloud</h2>
	<p>My Cloud is a website that allows you to store your pictures, music and documents in the cloud.<br>
	This allows you to acsess all of your stuff where-ever you are. You can listen to your music at your mates place or show off your photos. You can even keep documents on the cloud and access them when-ever you want them, and view and edit them right in your internet browser, without having to download them or have a word prosesser on the computer.<br>
	When you <a href="/createaccount" class="blacklink">create your free account</a> you are given 50MB of data to use on the site, this isn't quite enought to upload your music library or keep all of your photos but if you are looking at just using My Cloud for documents then this is no problem, you could upload the entire Bible 15 times with 50MB.<br>
	If you are looking at using My Cloud for streaming your music and keeping your photos online then just ask me in person or just send me an e-mail at <a href="mailto:jye@jyelewis.com" class="blacklink">jye@jyelewis.com</a> and I will be happy to help. Data is $1 for 100MB.<br>
	<h3>I hope you enjoy using My Cloud</h3>
</div>
<?php
if ($logedin)
{
	require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottom.php');
} else {
	require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottomlogin.php');
}
?>
