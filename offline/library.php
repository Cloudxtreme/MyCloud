<?php
$classdir 	= $_SERVER['DOCUMENT_ROOT'].'/../offline/classes/';
$tmpdir		= $_SERVER['DOCUMENT_ROOT'].'/../temp/';
$publicdir	= 'http://resources.jyelewis.com/';

foreach (glob($_SERVER['DOCUMENT_ROOT']."/../offline/scripts/*.php") as $filename)
{
    include $filename;
}

function __autoload($class_name) {
	global $classdir, $tmpdir;
@   include $classdir.$class_name . '.class.php';
}

function giveerror($error)
{
	$backtrace = debug_backtrace();
	$errorline = $backtrace[1]['line'];
	$filename  = $backtrace[1]['file'];
	echo 'Error: <i><u>'.htmlspecialchars($error).'</u></i> on line '.$errorline.' in '.htmlspecialchars($filename).PHP_EOL;
}
?>