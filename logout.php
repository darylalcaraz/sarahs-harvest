<?php

@include 'config.php';

session_start();
// clears session variable
session_unset();
// destroy session data for a specific user
session_destroy();

header('location:login.php');

?>