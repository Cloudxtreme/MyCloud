<?php
$verify = TRUE;
$config['bypassvalidation'] = TRUE;
require($_SERVER['DOCUMENT_ROOT'].'/../offline/start.php');
require('script.phpx');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/toplogin.php');
?>
<? echo $main; ?>
<?php
require($_SERVER['DOCUMENT_ROOT'].'/../offline/bottomlogin.php');
?>