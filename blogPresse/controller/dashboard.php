<?php

	//
	session_start();

	//	Si l'utilisateur n'est pas identifié
	if(!array_key_exists('userId', $_SESSION))
	{
		//	Redirection vers la page d'identification
		header('Location: models/sign-in.php');
		exit;
	}

require '../models/posts.models.php';
	$posts = getAllPostswithWriters();

	//	Inclusion du HTML
	require '../views/dashboard.phtml';
