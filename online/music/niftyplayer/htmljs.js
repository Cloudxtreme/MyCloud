	var playerId = 'niftyPlayer';
	var playerState;
	var loadingState;
	var numSongs; 
	var songIndex = 0;
	var prevSongIndex = 0;
	var songTitle;
	var prevSongTitle;
	var songUrl; 
	var btn_playpause;
	var niftyPlaylist;
	var nowPlayingDiv;
	var statusSpan;
	
	function init() {
		// Check to make sure niftyplayer is loaded from niftyplayer.js
		if (! niftyplayer(playerId)) {
			// try again in 250 ms
			window.setTimeout('init()', 250);
			return;
		}
   
		//add controls to #niftyControls div 	
		var player = document.getElementById(playerId);
		var controller = document.getElementById('niftyControls');
		nowPlayingDiv = document.getElementById('nowPlaying');
		niftyPlaylist = document.getElementById('niftyPlaylist');
		numSongs = countSongs(niftyPlaylist);
		
		//add event listener to handle clicks on songs in playlist
		if (niftyPlaylist.addEventListener) { 
			niftyPlaylist.addEventListener('click',function (e) { 
				e.preventDefault();
				prevSongIndex = songIndex;
				prevSongTitle = songTitle;
				songIndex = getSongIndex(e);
				loadSong(songIndex,niftyPlaylist);
			}, false);
		} 
		else if (niftyPlaylist.attachEvent) { //IE does things differently
			niftyPlaylist.attachEvent('onclick',function (e) { 
				if(e.preventDefault) e.preventDefault();
				else e.returnValue = false;
				prevSongIndex = songIndex;
				prevSongTitle = songTitle;
				songIndex = getSongIndex(e);
				loadSong(songIndex,niftyPlaylist);
			});
		} 
		
		btn_playpause = document.createElement('input');
		btn_playpause.setAttribute('type','button');
		btn_playpause.setAttribute('id','playpause');
		btn_playpause.setAttribute('value','');
		btn_playpause.setAttribute('title','Play');
		btn_playpause.setAttribute('onclick',"playpause()");
		btn_playpause.setAttribute('accesskey','P');
		controller.appendChild(btn_playpause);

		//If there's only one song, don't add previous & next buttons
		if (numSongs > 1) { 
			//add previous button 
			var btn_previous = document.createElement('input');
			btn_previous.setAttribute('type','button');
			btn_previous.setAttribute('id','previous');
			btn_previous.setAttribute('value','');
			btn_previous.setAttribute('title','Back to previous track');
			btn_previous.setAttribute('onclick','playPrevious()');			
			btn_previous.setAttribute('accesskey','B'); //B = back
			controller.appendChild(btn_previous);
		
			//add next button (same look as fast forward button in HTML5 controller)
			var btn_next = document.createElement('input');
			btn_next.setAttribute('type','button');
			btn_next.setAttribute('id','next');
			btn_next.setAttribute('value','');
			btn_next.setAttribute('title','Forward to next track');			
			btn_next.setAttribute('onclick','playNext()');			
			btn_next.setAttribute('accesskey','F'); //F = forward
			controller.appendChild(btn_next);
		}
		btn_stop = document.createElement('input');
		btn_stop.setAttribute('type','button');
		btn_stop.setAttribute('id','stop');
		btn_stop.setAttribute('value','');
		btn_stop.setAttribute('title','Stop');		
		btn_stop.setAttribute('onclick',"stopPlayer()");
		btn_stop.setAttribute('accesskey','S');
		controller.appendChild(btn_stop);

		statusSpan = document.createElement('span');
		statusSpan.setAttribute('id','status');
		statusSpan.setAttribute('title','Player status');
		statusSpan.setAttribute('tabindex','0');		
		controller.appendChild(statusSpan);
		
		// hide original player 
		// display:none doesn't work becuase then obj isn't acssible to API
		player.style.visibility='hidden';

		loadSong(songIndex,niftyPlaylist);
	}
	function playpause() { 

		//niftycontroller('niftycontroller').togglePlay()
		updatePlayerState();
		niftyplayer(playerId).playToggle();
		if (playerState == 'playing') { 
			//playToggle() will pause 
			btn_playpause.setAttribute('title','Play');
			btn_playpause.style.backgroundImage="url('images/audio_play.gif')";
		}
		else { //playToggle() will play
			btn_playpause.setAttribute('title','Pause');
			btn_playpause.style.backgroundImage="url('images/audio_pause.gif')";
		}
		updatePlayerState();
	}
	function playPrevious() { 
		prevSongIndex = songIndex;
		prevSongTitle = songTitle;
		if (songIndex == 0) { //this is the first song
			//loop around to end of playlist
			songIndex = numSongs-1;
		}
		else songIndex--;
		loadSong(songIndex,niftyPlaylist);
	}
	function playNext() { 
		prevSongIndex = songIndex;
		prevSongTitle = songTitle;
		if (songIndex == (numSongs - 1)) { //this is the lastsong
			//loop around to start of playlist
			songIndex = 0;
		}
		else songIndex++;
		loadSong(songIndex,niftyPlaylist);
	}
	function stopPlayer() { 
		niftyplayer(playerId).stop();
		btn_playpause.style.backgroundImage="url('images/audio_play.gif')";
		updatePlayerState();
	}
	function loadSong(songIndex,niftyPlaylist) { 

		//updates global variables songTitle and songUrl, and loads songUrl
		//if another song is already playing, auto starts playing new song
		var children = niftyPlaylist.childNodes;
		var count = 0;
		for (var i=0; i < children.length; i++) { 
			if (children[i].nodeName == 'LI') { 
				if (count == songIndex) { //this is the song
					children[i].setAttribute('class','focus');
					if (typeof songTitle != 'undefined') { 
						prevSongTitle = songTitle;
					}
					songTitle = children[i].childNodes[0].innerHTML;
					if (typeof prevSongTitle == 'undefined') { 
						prevSongTitle = songTitle;
					}
					var songUrl = children[i].childNodes[0].getAttribute('href');
					children[i].childNodes[0].innerHTML = songTitle + ' *';
					nowPlayingDiv.innerHTML = '<span>Now Playing:</span><br/>' + songTitle;
					updatePlayerState();
					if (playerState == 'playing') { 
						niftyplayer(playerId).loadAndPlay(songUrl);
					}
					else { 
						niftyplayer(playerId).load(songUrl);
					}
				}
				else if (count == prevSongIndex) { //this was the previous song
					//remove * from innerHTML
					children[i].childNodes[0].innerHTML = prevSongTitle;
					//remove .focus class
					children[i].removeAttribute('class');
				}
				count++;
			}
		}
		updatePlayerState();
	}
	function countSongs(niftyPlaylist) { 
		var children = niftyPlaylist.childNodes;
		var count = 0;
		var finished = false;
		for (var i=0; i < children.length && finished == false; i++) { 
			if (children[i].nodeName == 'LI') count++;
		}
		return count;
	}
	function getSongIndex(e) { 
		var eTarget = e.target; //should be a link 
		if (eTarget.nodeName == 'A') { 
			var eUrl = eTarget.getAttribute('href');
			var children = niftyPlaylist.childNodes;
			var count = 0;
			for (var i=0; i < children.length; i++) { 
				if (children[i].nodeName == 'LI') { 
					var thisSongUrl = children[i].childNodes[0].getAttribute('href');
					if (thisSongUrl == eUrl) { //this is the song
						return count;
					}
					count++;
				}
			}
		}
	}
	function updatePlayerState() { 
		if (niftyplayer(playerId)) { 
			playerState = niftyplayer(playerId).getState();
			if (playerState == 'empty') statusSpan.innerHTML='waiting';
			else if (playerState == 'loading') { 
				//register an event to change status to playing once playback starts
				niftyplayer(playerId).registerEvent('onPlay','updateStatus()');
				niftyplayer(playerId).registerEvent('onBufferingComplete','updateStatus()');
			}
			else statusSpan.innerHTML= playerState;
		}
	}
	function updateStatus() { 
		//only called when playerState is 'playing'
		statusSpan.innerHTML = "playing";
	}
	window.onload=init();