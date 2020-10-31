<?php
    session_start();
    $nom_qualification=$_POST["nom_qualification"];

    $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req=$bdd->prepare("SELECT id_qualification from qualification where nom_qualification=?;");
    $req->execute([$nom_qualification]);
    $data=$req->fetch();

    $id_qualification=$data["id_qualification"];

    $bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
    $req=$bdd->prepare("DELETE FROM jointure_utilisateur_qualifications where email_utilisateur=? and id_qualification=?;");
    $req->execute([$_SESSION["email"],$id_qualification]);

    header("Location:../qualification.php");

?>

