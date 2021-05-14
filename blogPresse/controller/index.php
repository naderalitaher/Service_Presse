<?php
//
session_start();

require '../models/posts.models.php';
$postsGauche = RecuperationArticleGauche();
$postsCentre = RecuperationArticleCentre();
$postsDroite = RecuperationArticleDroite();


// $req = InsertionImageCarrousel($image_path);

// $url = RecuperationImageCarrousel();

// $postsPopulaire = RecuperationArticlePopulaire();
// $postsPopulaire = RecuperationArticlePopulaire();
// $postsPopulaire = RecuperationArticlePopulaire();
// $postsPopulaire = RecuperationArticlePopulaire();

//	Inclusion du HTML
require '../views/index.phtml';
