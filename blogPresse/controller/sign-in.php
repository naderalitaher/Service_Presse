<?php

session_start();
    //    Inclusion du HTML

   
    //

    // $options = [
    //     'cost' => 12,
    // ];
    // echo password_hash("Nebraska", PASSWORD_BCRYPT, $options);
   
    //    Traitement du formulaire d'identification s'il a été soumis

    if(!empty($_POST))
    {

        require '../models/writers.models.php';

        $writer = RecuperationRedacteur($_POST['email']);

            //    S'il l'identification est réussie…
            if($writer !== false AND password_verify(trim($_POST['password']), $writer['hashedPassword']))
            {

                $_SESSION['userId'] = intval($writer['id']);
            //    Redirection vers le tableau de bord
            header('Location: ../controller/dashboard.php');
            exit;
            }
 else
        {
            //    Redirection vers la page d'identification
           echo 'Mauvais mot de passe </br>'; 
        //    var_dump($writer);
        //    echo password_hash('Nebraska', PASSWORD_DEFAULT);

            exit;
        }
    }
    require '../views/sign-in.phtml';
