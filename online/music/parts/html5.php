<script type="text/javascript">
	var audiotest  = document.createElement("audio"),
	canPlayMP3 = (typeof audiotest.canPlayType === "function" &&
              audiotest.canPlayType("audio/mpeg") !== "");
	if (!canPlayMP3){
	<?php
	if (isset($_GET['artist'])){ $addartist = '?artist='.$_GET['artist'].'&'; } else { $addartist = '?'; }
	?>
		window.location = '<? echo $addartist; ?>flash=1';
	}
	
	
	
 	function changebutton() {
 	$("#playpause").attr("src","/images/songpause.png");
 	}
 	var allowplay = '1';
    function loadPlayer() {
		if (/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent)){
			location.href('/music/flash');
			allowplay = '0';
		}
		if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)){
			var ieversion=new Number(RegExp.$1);
			if (ieversion<9){
				location.href('/music/flash');
				allowplay = '0';
			}
		}
		if (allowplay == '1')
		{
			var audioPlayer = new Audio();
			audioPlayer.controls="controls";
			audioPlayer.addEventListener('ended',nextSong,false);
			audioPlayer.addEventListener('error',errorFallback,true);
			document.getElementById("player").appendChild(audioPlayer);
			nextSong();
		}
    }

    function nextSong() {
        if(urls[next]!=undefined) {
            var audioPlayer = document.getElementsByTagName('audio')[0];
            if(audioPlayer!=undefined) {
                audioPlayer.src=urls[next][0];
                document.getElementById('songname').innerHTML = urls[next][1];
				$(".playing").removeClass("playing");
                $('#song'+next).addClass("playing");
                //songnamehtml.innerHTML = urls[next][1];
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
    	 urls[<? echo $song['jscriptid']; ?>] = new Array('/music/song.php?song=<? echo $song['id']; ?>', '<? echo addslashes(htmlspecialchars($song['jscriptname'])); ?>');
    	 <? } ?>

    var next = 0;
 
</script>
<?php if(isset($songs)){ ?>
<div id="playerhead">
<div id="player"></div>
<div id="songname"></div>
<a href="#" id="musicplay" onclick="playPause()"><img id="playpause" src="/images/songplay.png" alt="Play / Pause!" /></a>
<a href="#" onclick="nextSong()"><img src="/images/songforward.png" alt="Next track" /></a><br><br><br>
<input type="button" class="right" onclick="location.href='upload<? if(isset($_GET['artist'])){echo '?artistid='.$_GET['artist'];}?>'" value="Upload new song"><input type="button" class="right" onclick="location.href='artists'" value="Artists">
<?php echo $searchformcode; ?></div>
<div id="musiccontainer">
	<table id="docs" cellspaceing="0">
	<form method="POST" action="open/">
		</form>
		<tr class="title">
		<td class="songname title"><a class="blacklink" href="<? echo $sortartist; ?>order=name">Song name</a></td>
		<td class="albumartist title"><a class="blacklink" href="<? echo $sortartist; ?>order=artist">Artist</a></td>
		<td class="albumartist title"><a class="blacklink" href="<? echo $sortartist; ?>order=album">Album</a></td>
		<td class="date"><a class="blacklink" href="<? echo $sortartist; ?>order=lastplayed">Last Played</a></td>
		<td class="date"><a class="blacklink" href="<? echo $sortartist; ?>order=uploaded">Uploaded</a></td>
		<td class="size"><a class="blacklink" href="<? echo $sortartist; ?>order=size">Size</a></td>
		<td></td>
		</tr>
<?php $i=0; foreach($songs as $song){ ?>
<form method="post" action="edit/">
	<input type="hidden" name="song" value="<? echo $song['id']; ?>" />
	<input type="hidden" name="redirecturl" value="<? echo $_SERVER['REQUEST_URI']; ?>" />
	<tr id="song<? echo $song['jscriptid']; ?>" onclick="changebutton(); pickSong(<? echo $song['jscriptid']; ?>)"<?php echo tblclass($i); ?>>
		<td class="songname"><? echo $song['name']; ?></td>
		<td class="albumartist"><? echo $song['artist']; ?></td>
		<td class="albumartist"><? echo $song['album']; ?></td>
		<td class="docsdate"><? echo dategen($song['lastplayed']); ?></td>
		<td class="docsdate"><? echo dategen($song['uploaded']); ?></td>
		<td class="docssize"><? echo formatBytes($song['size']); ?></td>
		<td class="button"><input type="submit" name="edit" value="Edit" /></td>
	</tr></a>
</form>
<? $i++;
} echo '</table></div>'; } else { ?>
</table>
<input type="button" class="right" onclick="location.href='upload<? if(isset($_GET['artist'])){echo '?artistid='.$_GET['artist'];}?>'" value="Upload new song">
<input type="button" class="right" onclick="location.href='artists'" value="Artists">
You have no songs<? if(isset($_GET['artist'])) { echo ' by that artist'; } ?>!
<?php echo $searchformcode; ?>
<?php }
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottom.php');
?>
