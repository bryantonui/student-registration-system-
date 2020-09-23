<?php
session_start();
//destrot a session
session_destroy();

header('location: registerlogin.php');

?>