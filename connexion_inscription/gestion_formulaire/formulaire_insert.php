<?php
    $nom=strtoupper($_POST["nom"]);
    $prenom=strtoupper($_POST["prenom"]);
    $email=$_POST["email"];
    $adresse_actuelle=strtoupper($_POST["adresse_actuelle"]);
    $ville_de_residence=strtoupper($_POST["ville_de_residence"]);
    $date_naissance=$_POST["date_naissance"];
    $password=$_POST["password"];
    $lien_linkedin=$_POST["lien_linkedin"];
    $biographie=$_POST["biographie"];
    $num_telephone=$_POST["num_telephone"];
    $photo_profil=$_POST["photo_profil"];

    //on récupère les variables du formulaire à insérer dans la base de données
    //la fonction strtoupper permet de passer certaines variables en majuscules

    $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req_test=$bdd->prepare("SELECT COUNT(*) from utilisateur where email=?;");
        //on regarde si il existe déjà un compte avec la meme adresse email
    $req_test->execute([$email]);
    $data=$req_test->fetch();

    if($data[0]!=0)
    {
        //si il en existe déja on renvoie sur la pag d'inscription avec un message d'erreur
        header("Location: ../inscription.php?error=1");
        exit();
    }
    else
    {
        //sinon on insère les valeurs dans la table utilisateur pour créer une nouvelle entrée
        $bdd= new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
        $req=$bdd->prepare("INSERT INTO utilisateur VALUES (?,?,?,?,?,?,?,PASSWORD(?),?,?,?);");
        $req->execute([$email,$nom,$prenom,$adresse_actuelle,$ville_de_residence,$lien_linkedin,$date_naissance,$password,$biographie,$num_telephone,$photo_profil]);

        header("Location: ../../home/home.php?creation_compte");
        //on renvoie sur la page d'accueil en affichant dans l'url que le compte a été crée avec succès

    }
