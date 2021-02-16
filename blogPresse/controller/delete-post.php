<?php

	//
	session_start();

	//	Si l'utilisateur n'est pas identifié
	if(!array_key_exists('userId', $_SESSION))
	{
		//	Redirection vers la page d'identification
		header('Location: ../controller/sign-in.php');
		exit;
	}

	//	Connexion à la base de données
	$dbh = new PDO
	(
		'mysql:host=localhost;dbname=Blog2;port=3308;charset=utf8',
		'root',
		'',
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]
	);

	//	Récupération du nom de l'image de l'article
	$query =
	'
		SELECT
			imageFileName
		FROM
			Posts
		WHERE
			id = :id
			AND
			writerId = :writerId
	';
	$sth = $dbh->prepare($query);
	$sth->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
	$sth->bindValue(':writerId', $_SESSION['userId'], PDO::PARAM_INT);
	$sth->execute();
	$imageFileName = $sth->fetchColumn();

	//	Suppression de l'éventuelle image
	if(!is_null($imageFileName))
	{
		unlink('uploads/'.$imageFileName);
	}

	//	Suppression de l'article
	$query =
	'
		DELETE FROM
			Posts
		WHERE
			id = :id
			AND
			writerId = :writerId
	';
	$sth = $dbh->prepare($query);
	$sth->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
	$sth->bindValue(':writerId', $_SESSION['userId'], PDO::PARAM_INT);
	$sth->execute();

	//	Redirection vers le tableau de bord
	header('Location: ../controller/dashboard.php');
	exit;
