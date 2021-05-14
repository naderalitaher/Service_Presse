<?php

session_start();
    //    Inclusion du HTML

   

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
            header('Location: ../controller/sign-in.php');

            exit;
        }
    }
    require '../views/sign-in.phtml';
