<?php
//start config -----------------------------------------------------------------------------------------------------------------------------
$config['localwwwurl']			= 'http://localhost/'; //with trailing slash and with http e.g http://localhost/
$config['databaseurl']			= 'localhost'; //eg.http://localhost/
$config['database']				= 'phpinspector';
$config['mysqluser']			= 'phpinspector'; //this needs to have write and read privliges to the table "variables" eg. root
$config['mysqlpass']			= 'doctorrose'; //eg. password
$config['showbutton']			= TRUE; //wether to show the hide and launch inspector button on the page (TRUE or FALSE)
$config['requireauth']			= TRUE; //weather to require $_SESSION['inspector'] to be set before running - recomended for anything public
$inspectordblink = new mysqli($config['databaseurl'], $config['mysqluser'], $config['mysqlpass'], $config['database']) or die('unable to connect to db');
//end config -------------------------------------------------------------------------------------------------------------------------------
@session_start();
if ($config['requireauth']){ if (!isset($_SESSION['inspector']) && isset($_GET['inspector'])){ header('location:?'); exit(); }}
if ($config['requireauth']){ if (!isset($_SESSION['inspector']) && !isset($_GET['inspector'])){ $config['showbutton'] = FALSE; }}
echo '<!--using php inspector-->'."\n\n";
if (!isset($_GET['showerrors']) && !isset($_GET['inspector'])){ error_reporting(0); showbutton('?inspector=1', 'Launch inspector'); } else { error_reporting(-1); ini_set('error_reporting', 'On'); }

function showbutton($url, $text)
{
global $config;
if ($config['showbutton'])
{
?>
<!DOCTYPE html>
<style type="text/css">
	#inspectorbutton		{ z-index:99999;background-color:#eee;opacity:0.7;display:inline-block; border:1px solid #ccc; position:fixed; bottom:15px; right:15px; }
	#inspectorbutton:hover	{ opacity:1.0; }
</style>
<div onclick="location.href='<? echo $url; ?>'" id="inspectorbutton">
	<p style="margin: 22px;text-decoration:underline; font-weight:bold;" onclick="location.href='<? echo $url; ?>'"><? echo $text; ?></p>
</div>
<?php
}
}

function getDefinedVars($varList)
{

$excludeList = array('GLOBALS', '_FILES', '_COOKIE', '_POST', '_GET', 'excludeList', '_ENV', 'HTTP_ENV_VARS', 'HTTP_POST_VARS', 'HTTP_GET_VARS', 'HTTP_COOKIE_VARS', '_SERVER', 'HTTP_SERVER_VARS', 'HTTP_POST_FILES', '_REQUEST', 'config', 'inspectordblink');
    $temp1 = array_values(array_diff(array_keys($varList), $excludeList));
    $temp2 = array();
    while (list($key, $value) = each($temp1)) {
        global $$value;
        $temp2[$value] = $$value;
    }
    return $temp2;
}

function senddbvars($line, $varList)
{ global $inspectordblink;
//print_r(getDefinedVars($varList));
$allvars = getDefinedVars($varList);
$varkeys = array_keys($allvars);
$foundvars = FALSE;
foreach ($varkeys as $varkey)
{
//	echo $line.'.   '.$varkey.' = '.$allvars[$varkey]."\n\n";
	echo $varkey.'  ';
	if (is_array($allvars[$varkey])) {
		$allvars[$varkey] = urldecode(http_build_query($allvars[$varkey]));
		$allvars[$varkey] = str_replace("&", "**htmlbr**", $allvars[$varkey]);
		$allvars[$varkey] = str_replace("=", " = ", $allvars[$varkey]);
	}
	$varname = mysqli_escape_string($inspectordblink, '$'.$varkey);
	$varvalue = mysqli_escape_string($inspectordblink, $allvars[$varkey]);
	$sql = "INSERT INTO variables (rownum, varname, varvalue) VALUES ('$line', '{$varname}', '$varvalue')";
	mysqli_query($inspectordblink, $sql);
	$foundvars = TRUE;
}
if (!$foundvars)
{
	$sql = "INSERT INTO variables (rownum, varname, varvalue) VALUES ('$line', '', '')";
	mysqli_query($inspectordblink, $sql);
}
//exec('say '.$line);
}
if (isset($_GET['inspector']))
{
//start functions --------------------------------------------------------------------------------------------------------------------------
function isfound($check, $said) {
	$pattern = '/'.$check.'/i';
	preg_match($pattern, $said, $matches);
	if (isset($matches[0][1])) { return TRUE; } else { return FALSE; }
}

function findvars($scripthard, $location, $tmpdir)
{
	global $inspectordblink;
	$newscriptname = md5(rand()).'vars.php';
	$newscriptdir = $tmpdir.$newscriptname;
	$scripthardlines = preg_split( '/\r\n|\r|\n/', $scripthard);
	$linenum = 1;
	foreach ($scripthardlines as $line)
	{
		$linedata['line'] = $line;
		$linedata['linenum'] = $linenum;
		$scriptlinesdata[] = $linedata;
	$linenum++;
	}
	$lastline['line'] = '';
	$lastline['linenum'] = '';
	$linenum = 1;
	$runningphp = FALSE;
	$modedscript[] = "<?php ini_set('display_errors', 'On'); ?>";
	foreach ($scriptlinesdata as $line)
	{
		$modline = FALSE;
		if (preg_match("/;$/i", trim($lastline['line']))) { $modline = TRUE; }
		if (preg_match("/\{$/i", trim($lastline['line']))) { $modline = TRUE; }
		if (preg_match("/\}$/i", trim($lastline['line']))) { $modline = TRUE; }
		if (preg_match("/^\/\//i", trim($lastline['line']))) { $modline = TRUE; }
		if (trim($lastline['line']) == '') { $modline = TRUE; }
		
		if (preg_match("/\?>/i", trim($lastline['line']))) { $runningphp = FALSE; $modline = FALSE; }
		if (preg_match("/<\?/i", trim($lastline['line']))) { $runningphp = TRUE; }
		
			if ($modline && $linenum != 0 && $linenum != 1 && $linenum != 2)
			{
				$modedscript[] = "senddbvars('{$line['linenum']}', get_defined_vars());";
			}
			
			if (!$runningphp && $linenum > 2)
			{
				$modedscript[] = "<?php senddbvars('{$line['linenum']}', get_defined_vars()); ?>";
			}	
			
			
		$modedscript[] = $line['line'];
		$lastline = $line;
		$linenum++;
	}
	$finishedscript = implode("\n", $modedscript);
	file_put_contents($newscriptdir, $finishedscript);
	mysqli_query($inspectordblink, "DELETE FROM variables");
	$scriptlines = file($location.$newscriptdir.'?showerrors=1');
	unlink($newscriptdir);
	if (isset($error)) { return TRUE; } else { return FALSE; }
}

function finderrors($scripthard, $location, $tmpdir)
{
	$newscriptname = md5(rand()).'.php';
	$newscriptdir = $tmpdir.$newscriptname;
	file_put_contents($newscriptdir, $scripthard);
	$scriptlines = file($location.$newscriptdir.'?showerrors=1');
	unlink($newscriptdir);
	$linenum = 1;
	foreach($scriptlines as $line){
		if (isfound($newscriptname, $line))
		{
			$error = strip_tags($line);
			$errortags = $line;
			$errorlinenum = $linenum;
		}
		$linenum++;
	}
	findvars($scripthard, $location, $tmpdir);
	if (isset($error)) { preg_match('/(.*?) in <b>.*?<\/b> on line <b>(?P<errorline>\d+)<\/b>/', $errortags, $errorlineregex); }
	if (isset($error)) { return $errorlineregex; } else { return FALSE; }
}
//end functions ----------------------------------------------------------------------------------------------------------------------------

//start prossesing the error ---------------------------------------------------------------------------------------------------------------
	$linenum = 1;
	if (isset($_GET['line'])) { $fetchrow = $_GET['line']; $staticline = $_GET['line']; } else { $fetchrow = 250; $staticline = 250; }
	$scriptname = explode('/', $_SERVER['PHP_SELF']);
	$i = 1; foreach ($scriptname as $scriptpart){ if ($i != count($scriptname)){ $scriptlocation = $scriptpart.'/'; } $i++; }
	$scriptfilename = $_SERVER['SCRIPT_FILENAME'];
@	$filenamelength = strlen(end(explode('/',$scriptfilename)));
	$filenamelength = 0-$filenamelength;
	$scriptlocation = substr($_SERVER['PHP_SELF'], 0, $filenamelength);
	$scriptname = end($scriptname);
		$errorlineregex = finderrors(file_get_contents($scriptname), $config['localwwwurl'].$scriptlocation, '');
		$scripthardlines = file($scriptname);
		foreach($scripthardlines as $line){
			if ($linenum == $errorlineregex[2])
			{
				$codelinesinner['line'] = trim(htmlspecialchars($line));
				$codelinesinner['classes'] = 'rederror hover';
				$codelinesinner['linenum'] = $linenum;
				$iserror = TRUE;
			} else {
				$codelinesinner['line'] = trim(htmlspecialchars($line));
				if ($linenum%2==0){ $codelinesinner['classes'] = 'altrow hover'; } else { $codelinesinner['classes'] = 'hover'; }
				$codelinesinner['linenum'] = $linenum;
			}
			if ($staticline == $codelinesinner['linenum']){ $codelinesinner['classes'] .= ' selected'; }
			$codelines[] = $codelinesinner;
			$linenum++;
		}
		$result = mysqli_query($inspectordblink, "SELECT * FROM variables WHERE rownum='$fetchrow'");
		if (mysqli_num_rows($result) > 0)
		{
			$i = 1;
			while ($vardata = mysqli_fetch_array($result))
			{
				$rowdata['varname'] = htmlspecialchars($vardata['varname']);
				$rowdata['varvalue'] = htmlspecialchars($vardata['varvalue']);
				$rowdata['varvalue'] = str_replace("**htmlbr**", "<br>", $rowdata['varvalue']);
				if ($i%2==0){ $rowdata['classes'] = 'hover'; } else { $rowdata['classes'] = 'altrow hover'; }
				$allvardata[] = $rowdata;
				$i++;
			}
			$showvarform = TRUE;
		} else {
			//start looping to find old var lookups
				while(mysqli_num_rows($result) <= 0 && $fetchrow > 0)
				{
					$fetchrow = $fetchrow-1;
					$result = mysqli_query($inspectordblink, "SELECT * FROM variables WHERE rownum='$fetchrow'");
				}
					if (mysqli_num_rows($result) > 0)
					{
						$i = 1;
						while ($vardata = mysqli_fetch_array($result))
						{
							$rowdata['varname'] = htmlspecialchars($vardata['varname']);
							$rowdata['varvalue'] = htmlspecialchars($vardata['varvalue']);
							$rowdata['varvalue'] = str_replace("**htmlbr**", "<br>", $rowdata['varvalue']);
							if ($i%2==0){ $rowdata['classes'] = 'hover'; } else { $rowdata['classes'] = 'altrow hover'; }
							$allvardata[] = $rowdata;
							$i++;
						}
						$showvarform = TRUE;
					} else {
					$showvarform = FALSE;
					$error = ':/ PHP Inspector was unable to get the varibles on this line,<br>did u click on the first line?';
					}
			//end looping
		}
		//start html
		?>
		<html>
			<head>
				<title>PHP inspector</title>
				<style type="text/css">
					#widthlock		{ padding:0; margin:0; min-width:1200px; }
					table			{ border-collapse:collapse; border:1px solid #aaa; margin-bottom:10px; }
					tr				{ display:block; padding: 1px 0 1px 0; max-width:700px; }
					.linenum		{ padding-left:5px; min-width:15px; padding-right:5px; }
					.linecode		{ padding-right:8px; }
					.altrow			{ background-color:#eee; }
					.rederror		{ background-color:#faa; }
					#phperror		{ font-size:14px; text-decoration:underline; }
					#scriptlines	{ float:left; max-width:700px; }
					#varibledisplay	{ float:right; margin-top:20px; margin-right:50px; }
					.title			{ font-weight:bold; padding-top:5px; padding-bottom:7px;}
					.varname		{ padding: 1px 3px 1px 3px; width: 160px; }
					.varvalue		{ padding: 1px 3px 1px 15px; text-align:left; max-width:300px; }
					.selected		{ background-color:#aaa !important; color:#fff; }
					.hover:hover	{ background-color:#aaa !important; color:#fff; }
				</style>
			</head>
			<body>
			<div id="widthlock">
			<? showbutton('?', 'Close inspector'); ?>
				<div id="scriptlines">
					<? if (isset($iserror) && $iserror) { ?><b>Error:</b> <span id="phperror"><? echo strip_tags($errorlineregex[1]); ?></span><?}else{ echo '<br>';}?>
					<table border="0">
						<?php foreach ($codelines as $codeline) { ?>
							<tr class="<? echo $codeline['classes'] ?>" onclick="location.href='?inspector=1&line=<? echo $codeline['linenum'] ?>'">
								<td class="linenum"><? echo $codeline['linenum'] ?></td>
								<td class="linecode"><? echo $codeline['line'] ?></td>
							</tr>
						<? } ?>
					</table>
				</div>
				<div id="varibledisplay">
				<? if ($showvarform) { ?>
					<table>
						<tr class="title">
							<td class="varname">Varible name</td><td class="varvalue">Varible data</td>
						</tr>
						<?php foreach ($allvardata as $varline) { ?>
						<tr class="<? echo $varline['classes'] ?>">
							<td class="varname"><? echo $varline['varname']; ?></td><td class="varvalue"><? echo $varline['varvalue']; ?></td>
						</tr>
						<?php } ?>
					</table>
				<? } else { echo $error; } ?>
				</div>
			</div>
			</body>
		</html
		<?php
		//end html
	exit();
}
//end prossesing the error -----------------------------------------------------------------------------------------------------------------
?>