<?php 

require_once 'controller/core.php';

// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

header('location: http://localhost/sales-management-php/index.php');
