
<?php
require('fpdf182\fpdf.php');
/* permet de réaliser l'entete du pdf, prend en parametre le pdf ainsi qu'un tableau contenant plusisuers sortes de données*/
function entete($pdf,$dat,$data)
{
    // Logo
  // $pdf->Image("$dat[4]", 10, 6, 30);
    // Police Arial gras 15
    $pdf->SetFont('Arial', 'B', 20);
    // Décalage à droite
    $pdf->Cell(30);
    $pdf->Cell(30, 10, "$dat[0] ", 0, 0, 'c', '');
    $pdf->SetFont('Arial','',14); //changement de police
    $pdf->Image('tell.png', 125, 9, 5);
    $pdf->SetX(132);
    $pdf->Cell(90, 5, "$dat[2] ", 0, 0, 'c', ''); //telephone
    $pdf->SetFont('Arial', '', 20);
    $pdf->Ln(10);
    $pdf->Cell(30);
    $pdf->Cell(30, 10, "$dat[1]", 0, 0, 'c', '');
    $pdf->SetFont('Arial','',14); //changement de police
    $pdf->Ln(-5);
    $pdf->Image('mail.png', 125, 14, 6, 6);
    $pdf->SetX(132);
    $pdf->Cell(90, 7, "$dat[5] ", 0, 0, 'c', '');
    $pdf->Ln(5);
    $pdf->Image('linkedin.png', 125, 21, 6);
    $pdf->SetX(132);
    $pdf->Cell(70, 10, "$dat[6] ", 0, 0, 'c', '');
    $pdf->Ln(30);

}
function remplace($texte){
    $texte=str_replace("à","a",$texte);
    $texte=str_replace("é","e",$texte);
    $texte=str_replace("ô","o",$texte);
    $texte=str_replace("è","e",$texte);
    return $texte;
}
/*fonction permettant d'ecrire un texte ainsi qu'une en tête de de ce même texte dans un tableau situé à gauche du pdf
prend en parametre: un pdf, deux string */
function ajoutableaugauche($pdf,$entete,$texte){
    $pdf->SetrightMargin(115);
    $pdf->SetleftMargin(200);

    $pdf->SETX(6);
    $pdf->Cell(0, 5, $entete, 0, 0, 'c', '');
    $pdf->setX(35);
    $pdf->multicell(0, 5, $texte, 0,'c', '');
    $pdf->ln(2);
    $pdf->SetX(6);
    $pdf->SetrightMargin(0);
    $pdf->SetleftMargin(0);
}
/*fonction permettant d'ecrire un texte ainsi qu'une en tête de de ce même texte dans un tableau situé sur toute la longueur du pdf
prend en parametre: un pdf, deux string */
function ajoutableaulong($pdf,$entete,$texte){


    $pdf->SETX(6);
    $pdf->Cell(0, 5, $entete, 0, 0, 'c', '');
    $pdf->setX(35);
    $pdf->multicell(0, 5, $texte, 0,'c', '');
    $pdf->ln(2);
    $pdf->SetX(6);
}


/*fonction permettant d'ecrire un texte ainsi qu'une en tête de de ce même texte dans un tableau situé à droite du pdf
prend en parametre: un pdf, deux string */
function ajoutableaudroit($pdf,$entete,$texte){
    $pdf->SetrightMargin(0);
    $pdf->SetleftMargin(115);
    $pdf->SETX(107);
    $pdf->Cell(0, 5, $entete, 0, 0, 'c', '');
    $pdf->setX(107+30);
    $pdf->multicell(0, 5, $texte, 0,'c', '');
    $pdf->ln(2);
    $pdf->SetX(107);
    $pdf->SetrightMargin(0);
    $pdf->SetleftMargin(0);
}
class PDF extends FPDF
{
    //bas de page
    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial', 'I', 8);
        // Numéro de page
        $this->Cell(0, 10, ' CV Page ' . $this->PageNo() . '', 0, 0, 'C');
    }
}
$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$data=0;
$email = 'corentin.latimier@utbm.fr';
$sql=$bdd->prepare("SELECT  * FROM utilisateur WHERE email = ?");
$sql->execute([$email]);
$data=$sql->fetch();

//if ($dat!=false){


//$data =  $data['nom']. ';' . $data['prenom'].';'.'0'. $data['num_telephone'] . ';'. $data['adresse_actuelle']; //.$data['date_naissance'];
$dat[0]=$data['nom'];
$dat[1]=$data['prenom'];
$dat[2]=$data['num_telephone'];
$dat[3]=$data['adresse_actuelle'];
$dat[4]=$data['photo_profil'];
$dat[5]=$data['email'];
$dat[6]=$data['lien_linkedin'];
$pdf = new PDF();
$pdf->AddPage();


$pdf->Image('fond.jpg',0,0,210,300);
entete($pdf,$dat,$data);  //entete du pdf

$pdf->SetFont('Arial','',11); //changement de police



$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$data=0;
$sql=$bdd->prepare("SELECT  * FROM formation WHERE email_utilisateur = ?");
$sql->execute([$email]);
$data=$sql->fetch();
$sql=$bdd->prepare("SELECT  * FROM ecole INNER JOIN formation   WHERE ecole.id_ecole=formation.id_ecole and email_utilisateur = ?");
$sql->execute([$email]);
$data2=$sql->fetch();
$pdf->rect(5, 40, 200, 10, []);
$pdf->setXY(6,45);
$pdf->Cell(0, 0, 'Formation :', 0, 0, 'c', '');
$pdf->rect(5, 50, 200, 42, []);
$pdf->ln(6);
ajoutableaulong($pdf,'Ecole :',$data2['nom_ecole']);
$sql=$bdd->prepare("SELECT  * FROM type_diplome INNER JOIN formation   WHERE id_type_diplome=type_diplome and email_utilisateur = ?");
$sql->execute([$email]);
$data2=$sql->fetch();
$data2['description_formation']=remplace($data2['description_formation']);//remplace les caractere spéciaux
ajoutableaulong($pdf,'Nom diplome :',$data['intitule_diplome']);
ajoutableaulong($pdf,'Type diplome :',$data2['nom_type_diplome']);
ajoutableaulong($pdf,'Debut :',$data['date_de_debut']);
ajoutableaulong($pdf,'Fin :',$data['date_de_fin']);
ajoutableaulong($pdf,'Descirption :',$data2['description_formation']);

$data=0;
$sql=$bdd->prepare("SELECT  * FROM experiences_professionnelles WHERE email_utilisateur = ?");
$sql->execute([$email]);
$data=$sql->fetch();


if($data!=0){
    $pdf->SETXY(6,105);
    $pdf->cell(0,0,'Experience professionelle :',0,0,'L');
    $pdf->rect(5,100,97,10);
    $pdf->rect(5,110,97,70);
    $pdf->SETXY(6,112);
    $sql=$bdd->prepare("SELECT  * FROM experiences_professionnelles INNER JOIN entreprise   WHERE experiences_professionnelles.id_entreprise=entreprise.id_entreprise and experiences_professionnelles.email_utilisateur = ?");
    $sql->execute([$email]);
    $data2=$sql->fetch();
    ajoutableaugauche($pdf,'Entreprise :',$data2['nom_entreprise']);
    ajoutableaugauche($pdf,'Secteur activite :',$data2['secteur_activite']);
    ajoutableaugauche($pdf,'Type :',$data['type_contrat']);
    ajoutableaugauche($pdf,'Poste :',$data['poste_occupe']);
    $data['description']=remplace($data['description']);
    ajoutableaugauche($pdf,'Description :',$data['description']);



}
$data=0;
$sql=$bdd->prepare("SELECT  * FROM jointure_competence_utilisateur WHERE email_utilisateur = ?");
$sql->execute([$email]);
$data=$sql->fetch();

if($data!=0){

    $pdf->SETXY(107,105);
    $pdf->cell(0,0,'competence :',0,0,'L');
    $pdf->rect(107,100,98,10);
    $pdf->rect(107,110,98,28);
    $pdf->SETXY(101,112);
    $sql=$bdd->prepare("SELECT  * FROM competence INNER JOIN jointure_competence_utilisateur   WHERE jointure_competence_utilisateur.competence=competence.competence and jointure_competence_utilisateur.email_utilisateur = ?");
    $sql->execute([$email]);
    $data2=$sql->fetch();
    ajoutableaudroit($pdf,'Secteur :',$data2['secteur_competence']);
    ajoutableaudroit($pdf,'Competence :',$data['competence']);
    ajoutableaudroit($pdf,'Niveau :',$data2['niveau_competence']);
}
$data=0;
$sql=$bdd->prepare("SELECT  * FROM jointure_langue_utilisateur WHERE email_utilisateur = ?");
$sql->execute([$email]);
$data=$sql->fetch();

if($data!=0){

    $pdf->SETXY(107,145);
    $pdf->cell(0,0,'langue :',0,0,'L');
    $pdf->rect(107,140,98,10);
    $pdf->rect(107,150,98,30);
    $pdf->SETXY(101,152);

    ajoutableaudroit($pdf,'Langues :',$data['nom_langue']);
    ajoutableaudroit($pdf,'Niveau :',$data['niveau_langue']);
}
$data=0;

$sql=$bdd->prepare("SELECT  * FROM jointure_utilisateur_qualifications WHERE email_utilisateur = ?");
$sql->execute([$email]);
$data=$sql->fetch();

if($data!=0) {
    $pdf->rect(5, 185, 200, 10, []);
    $pdf->setXY(6, 190);
    $pdf->Cell(0, 0, 'Qualification :', 0, 0, 'c', '');
    $pdf->rect(5, 195, 200, 17, []);
    $pdf->ln(6);
    $sql = $bdd->prepare("SELECT  * FROM qualification INNER JOIN jointure_utilisateur_qualifications   WHERE jointure_utilisateur_qualifications.id_qualification=qualification.id_qualification and jointure_utilisateur_qualifications.email_utilisateur = ?");
    $sql->execute([$email]);
    $data2 = $sql->fetch();
    ajoutableaulong($pdf, 'Nom :', $data2['nom_qualification']);
    ajoutableaulong($pdf, 'Organisme :', $data2['organisme_delivrance']);

}
$data=0;

$sql=$bdd->prepare("SELECT  * FROM loisir WHERE email_user = ?");
$sql->execute([$email]);
$data=$sql->fetch();

if($data!=0) {
    $pdf->rect(5, 205, 200, 10, []);
    $pdf->setXY(6, 190);
    $pdf->Cell(0, 0, 'Loisir :', 0, 0, 'c', '');
    $pdf->rect(5, 215, 200, 17, []);
    $pdf->ln(6);
    ajoutableaulong($pdf, 'Nom :', $data['nom_loisir']);
    ajoutableaulong($pdf, 'Type :', $data['nom_type']);

}


$pdf->Output();