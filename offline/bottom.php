				<!-- end content here -->
			</div>
		</div>
	<div id="footercontainer">
		<div id="footer">
			<div class="lefttext">
				My Cloud &copy 2012
			</div>
			<div id="footlinks">
				<ul>
					<li><a href="/home">Home</a></li>
					<li><a href="/account">Account settings</a></li>
					<li><a href="/about">About</a></li>
					<li><a href="/logout">Logout</a></li>
				</ul>
			</div>
			<div class="righttext">
			<a href="/account" class="nohover">
				<div id="databar">
				<?php calculatedata(); if ($datausage['percent'] > 90){ $dataredwarning = 'background-color:#d35b5b !important'; } else { $dataredwarning = ''; } ?>
					<div id="innerdatabar" style="width:<? echo round($datausage['percent'], 0)*2; echo 'px;'.$dataredwarning; ?>;">
						<div id="percent"><?php echo round($datausage['percent'], 2).'%'; ?></div>
					</div>
				<div style="clear:both"></div>
				</div>
			</a>
			<div id="created">Created by Jye Lewis (<a href="http://twitter.com/jye265" target="blank">@jye265</a>)<div style="clear:both"></div></div>
			</div>
		</div>
	</div>
	</div>
</body>
</html>