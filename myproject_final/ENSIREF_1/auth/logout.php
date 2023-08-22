<?php
session_start();
session_destroy();
header('Location: /myproject_final/ENSIREF_1/index.php');
exit();
?>
