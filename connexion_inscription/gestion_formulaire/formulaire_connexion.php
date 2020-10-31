<?php

    $email=$_POST["email"];
    $password=$_POST["password"];
    //on récupère les variables du formulaire

    $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req_test=$bdd->prepare("SELECT COUNT(*) from utilisateur where email=? AND password=PASSWORD(?);");
    $req_test->execute([$email,$password]);
    $data=$req_test->fetch();

    //on compte le nombre de comptes qui correspondent

    if($data['COUNT(*)']==0)
    {
        //aucun compte ne correspond on renvoie une erreur dans l'url sur la page de connexion
        header("Location: ../connexion.php?error=1");
    }
    else{

        $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
        $req=$bdd->prepare("SELECT prenom,nom,photo_profil from utilisateur where email=?;");
        $req->execute([$email]);
        $data=$req->fetch();
        session_start();
        //si un compte correspond on récupère dans des variables de sesson le prenom,le nom,l'email et la photo de profil de l'utilisateur
        $_SESSION["prenom"]=$data["prenom"];
        $_SESSION["nom"]=$data["nom"];
        $_SESSION["photo_profil"]=$data["photo_profil"];
        $_SESSION["email"]=$email;


        header("Location: ../../home/home.php?connected");
        //on renvoie sur la page d'accueil avec la variable connected dans l'url
    }
?>