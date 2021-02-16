<?php

/**
 * 
 */

	session_start();


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
						
						require '../models/posts.models.php';

						AjouPosts($_POST['title'],$_POST['content'], $imageFileName,  $_SESSION['userId']);
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

	
	

		//	Redirection vers le tableau de bord
		
		header('Location: ../controller/dashboard.php');
		exit;
	}

	//	Inclusion du HTML
	require '../views/write-post.phtml';

	?>
