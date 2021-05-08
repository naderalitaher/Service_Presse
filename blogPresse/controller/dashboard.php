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
	// $posts = getAllPostswithWriters();
	$postsGauche = RecuperationArticleGauche();
    $postsCentre = RecuperationArticleCentre();
    $postsDroite = RecuperationArticleDroite();

	// $post = modifierArticle($title, $content, $imageFileName, $userId, $id);

	// $url = RecuperationImageCarrousel($path);

	$urlInsertion = InsertionImageCarrousel($_FILES['image']['tmp_name']);


	// $postsPopulaire = RecuperationArticlePopulaire();
	// $postsPopulaire = RecuperationArticlePopulaire();
	// $postsPopulaire = RecuperationArticlePopulaire();
	// $postsPopulaire = RecuperationArticlePopulaire();

	//	Inclusion du HTML
	require '../views/dashboard.phtml';
