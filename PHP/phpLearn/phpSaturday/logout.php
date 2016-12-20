<?php
include "init.php";
unset($_SESSION['username']);
header('location:'.BASE_URL.'login.php');