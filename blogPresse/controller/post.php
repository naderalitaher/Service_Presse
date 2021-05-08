<?php
// 

//
session_start();
// var_dump($_SESSION);

require '../models/posts.models.php';


$post = RecuperationArticle($_GET['id']);

// $post = RecuperationArticle($_SESSION['userId']=$post['id'];


// $_SESSION['userId']=$post['id']

//	Inclusion du HTML


require '../models/comments.models.php';

if (!empty($_POST)) {

	extract($_POST);
	$errors = array();

	$author = strip_tags($author);

	var_dump($author);

	$comment = strip_tags($content);

	if (empty($author))
		array_push($errors, 'Entrez votre email');

	if (empty($comment))
		array_push($errors, 'Entrez un commentaire');

	if (count($errors) == 0) {
		$comment = addComment($postId, $author, $content);

		$success = "Votre commentaire est soumis au modérateur avant d'être publié";
	}
}

$content = getComments($_GET['id']);


require '../views/post.phtml';
