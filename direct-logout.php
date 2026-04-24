<?php
session_start();
session_destroy();
header("Location: /direct-login.php");
exit;
?>