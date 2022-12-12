<?php 
session_start();
	if (isset($_SESSION['customerID'])) {
		header('location: cart.php');
	}else
		header('location: login.php');
 ?>