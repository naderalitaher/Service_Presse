<?php

function getAllComm() {
    
 $bdd = new PDO
 (
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
           Comments
     
   ';
   $sth = $bdd->query($query);
   
   $res = $sth->fetchAll();

   
   //return fetchAll

  return $res;
}

//fonction qui ajoute un commentaire en bdd

function addComment($postId, $author, $comment) {
        
 $bdd = new PDO
 (
     'mysql:host=localhost;dbname=Blog2;port=3308;charset=utf8',
     'root',
     '',
     [
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
     ]
 );

 $req = $bdd->prepare('INSERT INTO comments(postId, username, content) VALUES (?, ?, ?)');
 $req->execute(array($postId, $author, $comment));




 
}

//fonction qui recupere les commentaires d'un article

function getComments($id){
$bdd = new PDO
(
    'mysql:host=localhost;dbname=Blog2;port=3308;charset=utf8',
    'root',
    '',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);

$req = $bdd->prepare('SELECT * FROM comments WHERE postId = ?');
$req->execute(array($id));
$data = $req->fetchAll(PDO::FETCH_OBJ);
return $data;


}
?>