<?php
require('parts/top.php');
if (isset($_GET['flash']))
{
require('parts/flash.php');
} else {
require('parts/html5.php');
}
require('parts/bottom.php');
?>