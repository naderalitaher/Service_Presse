<?php

function RecuperationImageCarrousel($path)
{

	$bdd = new PDO(
		'mysql:host=localhost;dbname=Blog2;port=3308;charset=utf8',
		'root',
		'',
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]
	);

	$req =
		" 
	      SELECT 
		     image_Path
	      FROM 
		      carrousel
		      
		 

";
	//On prepare la requete 
	$req = $bdd->prepare($req);
	$req->bindValue(":image_path", $path, PDO::PARAM_STR);
	//On exécute la requete
	$req->execute();
	$url = $req->fetch();

	return $url;
}

function InsertionImageCarrousel($path)
{


	$bdd = new PDO(
		'mysql:host=localhost;dbname=Blog2;port=3308;charset=utf8',
		'root',
		'',
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]
	);


	$url =
		"
		  INSERT INTO 
	        carrousel 
	         (image_path) 
	      VALUES 
	         (:img)";

	//On prepare la requete 
	$query = $bdd->prepare($url);
	$query->bindValue(":img", $path);
	//On exécute la requete
	$url = $query->execute();
}




function getAllPosts()
{

	$bdd = new PDO(
		'mysql:host=localhost;dbname=Blog2;port=3308;charset=utf8',
		'root',
		'',
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]
	);



	//requete SELECT * FROM `comments` 

	$query =
		'
       SELECT
           *
       FROM
           posts
     
   ';
	$sth = $bdd->query($query);

	$res = $sth->fetchAll();


	//return fetchAll

	return $res;
}

function RecuperationArticleGauche()
{



	$bdd = new PDO(
		'mysql:host=localhost;dbname=Blog2;port=3308;charset=utf8',
		'root',
		'',
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]
	);

	$query =
		'
		SELECT
			posts.id,
			posts.title,
			posts.imageFileName,
			DATE_FORMAT(posts.publicationDate, \'%d/%m/%Y à %H:%i:%s\') AS publicationDate,
			posts.writerId,
			posts.position,
			writers.username AS writerUsername
		FROM
			posts
		INNER JOIN
			writers
		ON
			posts.writerId = writers.id

		WHERE
		    position = \'postGauche\'
		ORDER BY
            posts.publicationDate DESC	
		
		LIMIT 1 	

    ';
	$sth = $bdd->query($query);

	$postsGauche = $sth->fetchAll();


	//return fetchAll

	return $postsGauche;
}

function RecuperationArticleDroite()
{



	$bdd = new PDO(
		'mysql:host=localhost;dbname=Blog2;port=3308;charset=utf8',
		'root',
		'',
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]
	);

	$query =
		'
		SELECT
			posts.id,
			posts.title,
			posts.imageFileName,
			DATE_FORMAT(posts.publicationDate, \'%d/%m/%Y à %H:%i:%s\') AS publicationDate,
			posts.writerId,
			posts.position,
			writers.username AS writerUsername
		FROM
			posts
		INNER JOIN
			writers
		ON
			posts.writerId = writers.id
		WHERE
		    position = \'postDroite\' 
		ORDER BY 
		    publicationDate DESC
		LIMIT 1 
	
			
    ';
	$sth = $bdd->query($query);

	$postDroite = $sth->fetchAll();


	//return fetchAll

	return $postDroite;
}


function RecuperationArticleCentre()
{



	$bdd = new PDO(
		'mysql:host=localhost;dbname=Blog2;port=3308;charset=utf8',
		'root',
		'',
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]
	);

	$query =
		'
		SELECT
			posts.id,
			posts.title,
			posts.imageFileName,
			DATE_FORMAT(posts.publicationDate, \'%d/%m/%Y à %H:%i:%s\') AS publicationDate,
			posts.writerId,
			posts.position,
			writers.username AS writerUsername
		FROM
			posts
		INNER JOIN
			writers
		ON
			posts.writerId = writers.id
		WHERE
		    position = \'postCentre\' 
		ORDER BY 
		    publicationDate DESC
		LIMIT 3 
	
	
		
    ';
	$sth = $bdd->query($query);

	$postsCentre = $sth->fetchAll();


	//return fetchAll

	return $postsCentre;
}



function getPostsBywritersId($id)
{

	$bdd = new PDO(
		'mysql:host=localhost;dbname=Blog2;port=3308;charset=utf8',
		'root',
		'',
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]
	);

	// $bdd = bddCo();

	$query =
		'
		SELECT
			posts.id,
			posts.title,
			posts.content,
			posts.imageFileName,
			DATE_FORMAT(Posts.publicationDate, \'%d/%m/%Y à %H:%i:%s\') AS publicationDate,
			writers.username AS writerUsername
		FROM
			posts
		INNER JOIN
			writers
		ON
			posts.writerId = writers.id
		WHERE
			posts.writerId = :id
		ORDER BY
            posts.publicationDate DESC';

	$sth = $bdd->prepare($query);
	$sth->bindValue(':id', $id, PDO::PARAM_INT);
	$sth->execute();
	$posts = $sth->fetchAll();

	return $posts;
}

function AjouPosts($title, $content, $imageFileName, $userId, $position)
{

	$bdd = new PDO(
		'mysql:host=localhost;dbname=Blog2;port=3308;charset=utf8',
		'root',
		'',
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]
	);

	// $bdd = bddCo();

	$query =
		'
        INSERT INTO
            posts
            (title, content, imageFileName, writerId, position)
        VALUES
            (:title, :content, :imageFileName, :writerId, :position)
    ';
	$sth = $bdd->prepare($query);
	$sth->bindValue(':title', ($title), PDO::PARAM_STR);
	$sth->bindValue(':content', ($content), PDO::PARAM_STR);

	if (isset($imageFileName)) {
		$sth->bindValue(':imageFileName', $imageFileName, PDO::PARAM_STR);
	} else {
		$sth->bindValue(':imageFileName', null, PDO::PARAM_NULL);
	}
	$sth->bindValue(':writerId', $userId, PDO::PARAM_INT);
	$sth->bindValue(':position', $position, PDO::PARAM_STR);
	$sth->execute();
}

function RecuperationArticle($id)
{

	$bdd = new PDO(
		'mysql:host=localhost;dbname=Blog2;port=3308;charset=utf8',
		'root',
		'',
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]
	);

	// $bdd = bddCo();

	$query =
		'
		SELECT
			posts.id,
			posts.title,
			posts.content,
			posts.position,
			posts.imageFileName,
			DATE_FORMAT(posts.publicationDate, \'%d/%m/%Y à %H:%i:%s\') AS publicationDate,
			writers.username AS writerUsername
		FROM
			posts
		INNER JOIN
			writers
		ON
			posts.writerId = Writers.id
		WHERE
			posts.id = :id
			&&
			posts.position = \'gauche\'

			LIMIT 1
	';
	$sth = $bdd->prepare($query);
	$sth->bindValue(':id', $id, PDO::PARAM_INT);
	$sth->execute();
	$posts = $sth->fetch();

	return $posts;
}

function modifierArticle($title, $content, $imageFileName, $userId, $id)
{

	// $bdd = bddCo();

	$bdd = new PDO(
		'mysql:host=localhost;dbname=Blog2;port=3308;charset=utf8',
		'root',
		'',
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]
	);

	$query =
		'
		  UPDATE
				posts
			SET
				title = :title, content= :content, imageFileName = :imageFileName, writerId =:writerId
			
			WHERE id=:id

		';
	$sth = $bdd->prepare($query);
	$sth->bindValue(':title', trim($title), PDO::PARAM_STR);
	$sth->bindValue(':content', trim($content), PDO::PARAM_STR);
	$sth->bindValue(':id', trim($id), PDO::PARAM_INT);
	if (isset($imageFileName)) {
		$sth->bindValue(':imageFileName', $imageFileName, PDO::PARAM_STR);
	} else {
		$sth->bindValue(':imageFileName', null, PDO::PARAM_NULL);
	}
	$sth->bindValue(':writerId', $userId, PDO::PARAM_INT);
	$sth->execute();
}





/*function RecuperationArticlePopulaire()
{

	$bdd = new PDO(
		'mysql:host=localhost;dbname=Blog2;port=3308;charset=utf8',
		'root',
		'',
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]
	);

	// $bdd = bddCo();

	$query =
		'
	SELECT
		posts.id,
		posts.title,
		posts.imageFileName,
		DATE_FORMAT(Posts.publicationDate, \'%d/%m/%Y à %H:%i:%s\') AS publicationDate,
		posts.writerId,
		posts.position,
		writers.username AS writerUsername
	FROM
		posts
	INNER JOIN
		writers
	ON
		posts.writerId = writers.id
	WHERE
		populaire = 1
	
	LIMIT 3 


	
';
	$sth = $bdd->query($query);

	$res = $sth->fetchAll();


	//return fetchAll

	return $res;*/
