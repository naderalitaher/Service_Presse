<?php

	//
	session_start();

	//	Récupération du rédacteur
	require '../models/writers.models.php';
	$writer = getWriterById($_GET['id']);

	require '../models/posts.models.php';
	$posts = getPostsBywritersId($_GET['id']);

	//	Inclusion du HTML
	require '../views/writer.phtml';
