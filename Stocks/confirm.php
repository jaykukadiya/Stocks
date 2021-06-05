<?php 
session_start();
    $accept = $_POST['accept'];
    if($accept == "dck58" || $accept == "jk48"){
		$_SESSION["accept"] = "1";
		header("Location: index.php");
	}
	else{
		header("Location: index.php");
	}
?>
