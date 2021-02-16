<?php
	//
	session_start();

	require '../models/posts.models.php';
	$posts = getAllPostswithWriters();

	//	Inclusion du HTML
	require '../views/index.phtml';
