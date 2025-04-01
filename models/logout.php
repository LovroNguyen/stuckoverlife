<?php
session_start();
session_destroy();
header('Location: /coursework/index.php');
exit();
?>