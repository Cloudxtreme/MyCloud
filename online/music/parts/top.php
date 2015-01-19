<?php
//
$verify = TRUE;
require($_SERVER['DOCUMENT_ROOT'].'/../offline/start.php');
require('script.phpx');
require($_SERVER['DOCUMENT_ROOT'].'/../offline/top.php');
?>
<!-- styles needed by jScrollPane -->
<script type="text/javascript" language="javascript" src="/music/niftyplayer/niftyplayer.js"></script>
<link type="text/css" href="http://resources.jyelewis.com/scroll/scroll.css" rel="stylesheet" media="all" />
<script type="text/javascript" src="http://resources.jyelewis.com/scroll/mousewheel.js"></script>
<script type="text/javascript" src="http://resources.jyelewis.com/scroll/scroll.js"></script>
<script type="text/javascript"> $(function() { $('#musiccontainer').jScrollPane(); });</script>