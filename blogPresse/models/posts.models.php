<?php


// function bddCo()
// {
// 	$bdd = new PDO(
// 			'mysql:host=localhost;dbname=Blog2;port=3308;charset=utf8',
// 			'root',
// 			'',
// 			[
// 				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
// 				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
// 			]
// 		);

// 	return $bdd; $bdd = bddCo();
// }

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
           Posts
     
   ';
	$sth = $bdd->query($query);

	$res = $sth->fetchAll();


	//return fetchAll

	return $res;
}

function getAllPostswithWriters()
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
			Posts.id,
			Posts.title,
			Posts.imageFileName,
			DATE_FORMAT(Posts.publicationDate, \'%d/%m/%Y à %H:%i:%s\') AS publicationDate,
			Posts.writerId,
			Writers.username AS writerUsername
		FROM
			Posts
		INNER JOIN
			Writers
		ON
			Posts.writerId = Writers.id
		ORDER BY
			Posts.publicationDate DESC
    ';
	$sth = $bdd->query($query);

	$res = $sth->fetchAll();


	//return fetchAll

	return $res;


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
			Posts.id,
			Posts.title,
			Posts.content,
			Posts.imageFileName,
			DATE_FORMAT(Posts.publicationDate, \'%d/%m/%Y à %H:%i:%s\') AS publicationDate,
			Writers.username AS writerUsername
		FROM
			Posts
		INNER JOIN
			Writers
		ON
			Posts.writerId = Writers.id
		WHERE
			Posts.writerId = :id
		ORDER BY
            Posts.publicationDate DESC';
	$sth = $bdd->prepare($query);
	$sth->bindValue(':id', $id, PDO::PARAM_INT);
	$sth->execute();
	$posts = $sth->fetchAll();

	return $posts;
}

function AjouPosts($title, $content, $imageFileName, $userId)
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
            Posts
            (title, content, imageFileName, writerId)
        VALUES
            (:title, :content, :imageFileName, :writerId)
    ';
	$sth = $bdd->prepare($query);
	$sth->bindValue(':title', trim($title), PDO::PARAM_STR);
	$sth->bindValue(':content', trim($content), PDO::PARAM_STR);
	if (isset($imageFileName)) {
		$sth->bindValue(':imageFileName', $imageFileName, PDO::PARAM_STR);
	} else {
		$sth->bindValue(':imageFileName', null, PDO::PARAM_NULL);
	}
	$sth->bindValue(':writerId', $userId, PDO::PARAM_INT);
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
			Posts.id,
			Posts.title,
			Posts.content,
			Posts.imageFileName,
			DATE_FORMAT(Posts.publicationDate, \'%d/%m/%Y à %H:%i:%s\') AS publicationDate,
			Writers.username AS writerUsername
		FROM
			Posts
		INNER JOIN
			Writers
		ON
			Posts.writerId = Writers.id
		WHERE
			Posts.id = :id
	';
	$sth = $bdd->prepare($query);
	$sth->bindValue(':id', $id, PDO::PARAM_INT);
	$sth->execute();
	$post = $sth->fetch();

	return $post;
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
				Posts
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
