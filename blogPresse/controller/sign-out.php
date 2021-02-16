<?php
session_start();
session_unset();
session_destroy();
	//	Redirection vers la page d'identification
	header('location: ../controller/index.php');
	exit;
