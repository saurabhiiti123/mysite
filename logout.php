<?php
session_start();
session_destroy();
echo '<script>window.location.assign("homepage.php");</script>'
//print_r($_SESSION);
?>