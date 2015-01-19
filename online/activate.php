<?php
session_start();
if (isset($_POST['pass']) && $_POST['pass'] == 'jyesphp') { $_SESSION['inspector'] = TRUE; echo 'inspector activated!<Br>'; }
?>
<form method="POST">
inspector password: <input type="password" name="pass">
<br><input type="submit" value="activate inspector" />