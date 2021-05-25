<?php
//
session_start();

require '../models/posts.models.php';
$postsGauche = RecuperationArticleGauche();
$postsCentre = RecuperationArticleCentre();
$postsDroite = RecuperationArticleDroite();


var_dump($path);

// $postsPopulaire = RecuperationArticlePopulaire();
// $postsPopulaire = RecuperationArticlePopulaire();
// $postsPopulaire = RecuperationArticlePopulaire();
// $postsPopulaire = RecuperationArticlePopulaire();

//	Inclusion du HTML
require '../views/index.phtml';
