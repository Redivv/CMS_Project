<?php
session_start();    // rozpoczynamy sesję

$_SESSION = array();    // czyścimy zawartość sesji

session_destroy();      // niszczymy utworzoną sesję

header("location: index.php");    // wypierdalamy na login
exit;
?>
