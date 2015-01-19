<?php

$verify = TRUE;
require($_SERVER['DOCUMENT_ROOT'].'/../offline/start.php');
require('script.phpx');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/top.php');
?>
<div class="big databar">
	<?php if ($datausage['percent'] > 90){ $dataredwarning = 'background-color:#d35b5b !important'; } else { $dataredwarning = ''; } ?>
	<div class="innerdatabar" style="width:<? echo round($datausage['percent']*8.8, 0); echo 'px;'.$dataredwarning; ?>;">
		<span class="percent"><?php echo round($datausage['percent'], 2).'%'; ?></span>
	</div>
</div>
<table border="0" cellspaceing="0">
<tr><td class="tblheader">Account Settings</td><td class="tblsmall">(click to edit)</td><td><?php echo $error; ?></td></tr>
<form id="form" method="POST">
<tr><td class="datalabel">Username:</td><td class="editbox"><?php echo $user['username'] ?></td></tr>
<tr><td class="datalabel">Full name:</td><td class="editbox"><input class="autosubmit" name="newname" type="text" value="<?php echo $user['fullname'] ?>" autocomplete='off'/></td></tr>
<tr><td class="datalabel">E-mail address:</td><td class="editbox"><input class="autosubmit" name="newemail" type="text" value="<?php echo $user['email'] ?>" autocomplete='off'/></td></tr>
<tr><td class="datalabel">Password:</td><td class="editbox"><input class="autosubmit" name="newpass" type="password" value="password" onfocus="this.value = '';"/></td></tr>
<tr><td>&nbsp</td></tr>
<tr><td class="datalabel">Total data used:</td><td><?php echo formatBytes($datausage['used']) ?></td></tr>
<tr><td class="datalabel">Total data remaining:</td><td><?php echo formatBytes($datausage['remaining']) ?></td></tr>
<tr><td class="datalabel">Total data allowed:</td><td><?php echo formatBytes($datausage['allowed']) ?></td></tr>
<tr><td>&nbsp</td></tr>
<tr><td class="datalabel">Documents:</td><td><?php echo formatBytes($datausage['documents']) ?></td></tr>
<tr><td class="datalabel">Music:</td><td><?php echo formatBytes($datausage['music']) ?></td></tr>
<tr><td class="datalabel">Pictures:</td><td><?php echo formatBytes($datausage['pictures']) ?></td></tr>
<tr><td>&nbsp</td></tr>
<tr><td class="datalabel">iPhone music player:</td><td><a href="/iphoneplayer/?iphoneid=<?php echo $user['iphoneid'] ?>" class="blacklink">http://mycloud.jyelewis.com/iphoneplayer/?iphoneid=<?php echo $user['iphoneid'] ?></a></td></tr>
</table>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottom.php');
?>
