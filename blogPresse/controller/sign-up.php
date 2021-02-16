<?php

	//
	session_start();

	//	Traitement du formulaire d'inscription s'il a été soumis
	if(!empty($_POST))
	{
	

		require '../models/writers.models.php';
		AjoutRedacteur($_POST['username'], $_POST['password']);

		//	Redirection vers la page d'identification
		header('Location: ../controller/sign-in.php');
		exit;
	}

	//	Inclusion du HTML
	require '../views/sign-up.phtml';
