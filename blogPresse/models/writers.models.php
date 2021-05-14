<?php

function bddCo()
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
    return $bdd;
}




function getWriterById($id)
{

    $bdd = bddCo();

    //requete SELECT * FROM `writers` 

    $query =
        '
        SELECT
       *
    FROM
        Writers
    WHERE
        id = :id
';
    $sth = $bdd->prepare($query);
    $sth->bindValue(':id', $id, PDO::PARAM_INT);
    $sth->execute();
    $writer = $sth->fetch();

    return $writer;
}

function AjoutRedacteur($username, $password)
{
    // require 'connexion.bdd.php';

    $bdd = bddCo();

    $query =
        '
			INSERT INTO
				Writers
				(username, hashedPassword)
			VALUES
				(:username, :hashedPassword)';
    $sth = $bdd->prepare($query);
    $sth->bindValue(':username', trim($username), PDO::PARAM_STR);
    $sth->bindValue(':hashedPassword', password_hash(trim($password), PASSWORD_BCRYPT), PDO::PARAM_STR);
    $sth->execute();
}

function RecuperationRedacteur($username)
{

    $bdd = bddCo();

    // require 'connexion.bdd.php';

    $query =
        '
        SELECT
            id,
            username,
            hashedPassword
        FROM
            Writers
        WHERE
            username = :username
    ';
    $sth = $bdd->prepare($query);
    $sth->bindValue(':username', trim($username), PDO::PARAM_STR);
    $sth->execute();
    $writer = $sth->fetch();

    return $writer;
}
