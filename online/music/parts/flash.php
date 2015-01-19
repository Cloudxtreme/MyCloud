<script type="text/javascript" language="javascript"> 
 	function changebutton() {
 	$("#playpause").attr("src","/images/songpause.png");
 	}

    function loadPlayer() {
		nextSong();
    }

	function checkOver() {
		if (niftyplayer('niftyPlayer1').getState() == 'finished') {
			nextSong();
		}
	}
	
    function nextSong() {
        if(!urls[next]!=undefined) {
                niftyplayer('niftyPlayer1').loadAndPlay(urls[next][0]);
                setInterval( "checkOver()", 500 );
                //niftyplayer('niftyPlayer1').registerEvent('onSongOver', 'nextSong()');
                document.getElementById('songname').innerHTML = urls[next][1];
                $(".playing").removeClass("playing");
                $('#song'+next).addClass("playing");
                //songnamehtml.innerHTML = urls[next][1];
                next++;
        }
    }
    function errorFallback() {
            nextSong();
    }
	//function regevent(){ niftyplayer('niftyPlayer1').registerEvent('onPlay', 'firstbold()'); }
   
   
    function playPause() {
            if (niftyplayer('niftyPlayer1').getState() == 'playing') {
                niftyplayer('niftyPlayer1').pause()
                $("#playpause").attr("src","/images/songplay.png");
            } else {
            	if (niftyplayer('niftyPlayer1').getState() == 'paused') {
              		niftyplayer('niftyPlayer1').play();
              		firstbold();
               		$("#playpause").attr("src","/images/songpause.png");
            	} else {
            			nextSong();
            			$("#playpause").attr("src","/images/songpause.png");
            	}
            }
    }
    
	function pickSong(num) {
        next = num;
        nextSong();
    }
    
 	function firstbold()
 	{
 		if ($(".playing").length == 0)
 		{
 		$("song0").addClass("playing");
 		}
 	}
 	
    var urls = new Array();
    	<?php foreach($songs as $song){ ?>
    	 urls[<? echo $song['jscriptid']; ?>] = new Array('/music/song.php?song=<? echo $song['id']; ?>', '<? echo addslashes(htmlspecialchars($song['jscriptname'])); ?>');
    	 <? } ?>

    var next = 0;
 
</script>
<?php if(isset($songs)){ ?>
<div id="playerhead">
<div id="player">
		<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="165" height="37" id="niftyPlayer1" align="">
		 <param name=movie value="/music/niftyplayer/niftyplayer.swf?file=/music/song.php?song=<? echo $songs[0]['id']; ?>&as=0">
		 <param name=quality value=high>
		 <param name=bgcolor value=#999999>
		 <embed src="/music/niftyplayer/niftyplayer.swf?file=/music/song.php?song=<? echo $songs[0]['id']; ?>&as=0" quality=high bgcolor=#999999 width="165" height="37" name="niftyPlayer1" align="" type="application/x-shockwave-flash" swLiveConnect="true" pluginspage="http://www.macromedia.com/go/getflashplayer">
		</embed>
		</object>
</div>
<div id="playerhead">
<div id="songname"></div>
<a href="#" id="musicplay" onclick="playPause()"><img id="playpause" src="/images/songplay.png" alt="Play / Pause!" /></a>
<a href="#" onclick="nextSong()"><img src="/images/songforward.png" alt="Next track" /></a><br><br><br>
<input type="button" class="right" onclick="location.href='/music/upload<? if(isset($_GET['artist'])){echo '?artistid='.$_GET['artist'];}?>'" value="Upload new song"><input type="button" class="right" onclick="location.href='/music/artists'" value="Artists">
<?php echo $searchformcode; ?></div>
<div id="musiccontainer">
	<table id="docs" cellspaceing="0">
	<form method="POST" action="open/">
		</form>
		<tr class="title">
		<td class="songname title"><a class="blacklink" href="<? echo $sortartist; ?>order=name&flash=1">Song name</a></td>
		<td class="albumartist title"><a class="blacklink" href="<? echo $sortartist; ?>order=artist&flash=1">Artist</a></td>
		<td class="albumartist title"><a class="blacklink" href="<? echo $sortartist; ?>order=album&flash=1">Album</a></td>
		<td class="date"><a class="blacklink" href="<? echo $sortartist; ?>order=lastplayed&flash=1">Last Played</a></td>
		<td class="date"><a class="blacklink" href="<? echo $sortartist; ?>order=uploaded&flash=1">Uploaded</a></td>
		<td class="size"><a class="blacklink" href="<? echo $sortartist; ?>order=size&flash=1">Size</a></td>
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
} echo '</table></div></div>'; } else { ?>
</table>
<input type="button" class="right" onclick="location.href='upload<? if(isset($_GET['artist'])){echo '?artistid='.$_GET['artist'];}?>'" value="Upload new song">
<input type="button" class="right" onclick="location.href='artists'" value="Artists">
You have no songs<? if(isset($_GET['artist'])) { echo ' by that artist'; } ?>!
<?php echo $searchformcode; ?>
<?php }
if (isset($_GET['artist']))
{
	mempage('/music?artist='.$_GET['artist']);
} else {
	mempage('/music');
}
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottom.php');
?>
