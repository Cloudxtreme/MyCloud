<?php
$dir = substr($_SERVER['PHP_SELF'], 0, strlen(end(explode('/', $_SERVER['PHP_SELF'])))*(-1));
setdebugcookie($dir);

function setdebugcookie($dir)
{
	if (setcookie("XDEBUG_SESSION", "macgdbp", time() + 2600, $dir))
	{
		return TRUE;
	}
	return FALSE;
}
?>