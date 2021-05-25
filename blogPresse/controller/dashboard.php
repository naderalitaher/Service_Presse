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

	// $urlInsertion = InsertionImageCarrousel($path);


 var_dump($path); 
 
 $msg = '';
	if (isset($_POST['upload'])) {
		$image = 'img/logo_Service_Presse/'.uniqid().'.'.pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
		$path = 'img/' . $image;

    var_dump($_POST, $_FILES);
    require '../models/posts.models.php';
		if ($req) {
			//utiliser la fonction
			move_uploaded_file($_FILES['image']['tmp_name'], $path);
			$msg = 'l"image a été chargée avec succés!';
		} else {
			$msg = 'Echec du chargement de l"image!';
		}
	}
	
	// <br><br><br><br>

	/*<?php  $msg = '';
	if (isset($_POST['upload'])) {
		$image = $_FILES['image']['name'];
		$path = 'img/' . $image;

		var_dump($_POST, $_FILES);

		if ($req) {
			//utiliser la fonction
			move_uploaded_file($_FILES['image']['tmp_name'], $path);
			$msg = 'l"image a été chargée avec succés!';
		} else {
			$msg = 'Echec du chargement de l"image!';
		}
	}
	?>*/
	// $postsPopulaire = RecuperationArticlePopulaire();
	// $postsPopulaire = RecuperationArticlePopulaire();
	// $postsPopulaire = RecuperationArticlePopulaire();
	// $postsPopulaire = RecuperationArticlePopulaire();

	//	Inclusion du HTML
	require '../views/dashboard.phtml';
