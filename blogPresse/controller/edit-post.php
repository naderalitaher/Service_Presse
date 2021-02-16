<?php

	session_start();
// var_dump($_POST, $_FILES);
	require '../models/posts.models.php';

	

	//	Si l'utilisateur n'est pas identifié
	if(!array_key_exists('userId', $_SESSION))
	{
		//	Redirection vers la page d'identification
		header('Location: ../controller/sign-in.php');
		exit;
	}

	//	Traitement du formulaire de publication d'un article s'il a été soumis
	if(!empty($_POST))
	{
		if(array_key_exists('image', $_FILES))
		{
			if($_FILES['image']['error'] == 0)
			{
				if(in_array(mime_content_type($_FILES['image']['tmp_name']), ['image/png', 'image/jpeg']))
				{
					if($_FILES['image']['size'] <= 3000000)
					{
						$imageFileName = uniqid().'.'.pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

						move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/'.$imageFileName);
					}
					else
					{
						echo 'Le fichier est trop volumineux…';
					}
				}
				else
				{
					echo 'Le type mime du fichier est incorrect…';
				}
			}
			else
			{
				echo 'Le fichier n\'a pas pu être récupéré…';
			}
		}

		//	Connexion à la base de données
		// $dbh = new PDO
		// (
		// 	'mysql:host=localhost;dbname=Blog2;port=3308;charset=utf8',
		// 	'root',
		// 	'',
		// 	[
		// 		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		// 		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		// 	]
		// );

		//	Modification de l'article
		// $query =
		// '
		//   UPDATE
		// 		Posts
		// 	SET
		// 		title = :title, content= :content, imageFileName = :imageFileName, writerId =:writerId

		// ';
		// $sth = $dbh->prepare($query);
		// $sth->bindValue(':title', trim($_POST['title']), PDO::PARAM_STR);
		// $sth->bindValue(':content', trim($_POST['content']), PDO::PARAM_STR);
		
		
		// if(isset($imageFileName))
		// {
		// 	$sth->bindValue(':imageFileName', $imageFileName, PDO::PARAM_STR);
		// }
		// else
		// {
		// 	$sth->bindValue(':imageFileName', null, PDO::PARAM_NULL);
		// }
		// $sth->bindValue(':writerId', $_SESSION['userId'], PDO::PARAM_INT);
		// $sth->execute();

		
	
		modifierArticle($_POST['title'],$_POST['content'], $imageFileName, $_SESSION['userId'], $_POST['id']);

		//	Redirection vers le tableau de bord
		header('Location: ../controller/dashboard.php');
		exit;
	}

	//	Inclusion du HTML
	require '../views/edit-post.phtml';

	?>
