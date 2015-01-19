<?php
$time_start = microtime(true);
include('index.php');
echo 'script took: ';
echo microtime(true) - $time_start.'<br>';
?>
