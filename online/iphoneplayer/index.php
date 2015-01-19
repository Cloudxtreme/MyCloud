<?php
$verify = TRUE;
require('script.phpx');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>MyCloudMusic</title>
<link rel="stylesheet" type="text/css" href="iphonestyle.css" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<link rel="apple-touch-icon-precomposed" href="/images/iphoneicon.png"/>
<link rel="apple-touch-startup-image" href="/images/iphonestart.png" /> 
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
<?php include($_SERVER['DOCUMENT_ROOT'].'/../offline/javascript.php'); ?>
</head>
<body class="normal">
<script type="text/javascript">
 	function changebutton() {
 	$("#playpause").attr("src","/images/songpause.png");
 	}
 	
    function loadPlayer() {
        var audioPlayer = new Audio();
        audioPlayer.controls="controls";
        audioPlayer.addEventListener('ended',nextSong,false);
        audioPlayer.addEventListener('error',errorFallback,true);
        document.getElementById("player").appendChild(audioPlayer);
        nextSong();
    }
    function nextSong() {
        if(urls[next]!=undefined) {
            var audioPlayer = document.getElementsByTagName('audio')[0];
            if(audioPlayer!=undefined) {
                audioPlayer.src=urls[next];
                audioPlayer.load();
                audioPlayer.play();
                next++;
            } else {
                loadPlayer();
            }
        } else {
        }
    }
    function errorFallback() {
            nextSong();
    }
    function playPause() {
        var audioPlayer = document.getElementsByTagName('audio')[0];
        if(audioPlayer!=undefined) {
            if (audioPlayer.paused) {
                audioPlayer.play();
                $("#playpause").attr("src","/images/songpause.png");
            } else {
                audioPlayer.pause();
                $("#playpause").attr("src","/images/songplay.png");
            }
        } else {
            loadPlayer();
            $("#playpause").attr("src","/images/songpause.png");
        }
    }
    function pickSong(num) {
        next = num;
        nextSong();
    }
 
    var urls = new Array();
    	<?php foreach($songs as $song){ ?>
    	 urls[<? echo $song['jscriptid']; ?>] = '/music/song.php?song=<? echo $song['id']; ?>';
    	 <? } ?>

    var next = 0;
 
</script>
<?php if(isset($songs)){ ?>
<div id="menuspace"></div>
<div id="player"></div>
<div id="buttons">
<a href="#" id="musicplay" onclick="playPause()"><img id="playpause" src="/images/songplay.png" alt="Play / Pause!" /></a>
<a href="#" id="next" onclick="nextSong()"><img src="/images/songforward.png" alt="Next track" /></a>
</div>
	<table id="docs" cellspaceing="0">
		<tr class="title">
		<td id="songname">Song name</a></td>
		<td class="albumartist">Artist</a></td>
		</tr>
<?php $i=0; foreach($songs as $song){ ?>
	<tr onclick="changebutton(); pickSong(<? echo $song['jscriptid']; ?>)"<?php echo tblclass($i); ?>>
		<td id="songname"><? echo $song['name']; ?></td>
		<td id="albumartist"><? echo $song['artist']; ?></td>
	</tr></a>
<? $i++;
} echo '</table>'; } else { ?>
</table>
You have no songs<? if(isset($_GET['artist'])) { echo ' by that artist'; } ?>!
<?php }
?>