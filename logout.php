<?php
session_start();
unset($_SESSION['usernamme']);
unset($_SESSION['password']);
session_destroy();
header('location: login.php');

?>