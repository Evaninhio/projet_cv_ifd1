
<?php
require('fpdf182\fpdf.php');
class PDF extends FPDF
{
    // En-tête
    function Header()
    {
        // Logo
        $this->Image('logo.png', 10, 6, 30);
        // Police Arial gras 15
        $this->SetFont('Arial', 'B', 20);
        // Décalage à droite
        $this->Cell(60);
        // Titre
        $this->Cell(60, 10, 'curriculum vitae ', 1, 0, 'C');
        // Saut de ligne
        $this->Ln(20);
    }

// Pied de page
    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial', 'I', 8);
        // Numéro de page
        $this->Cell(0, 10, ' CV Page ' . $this->PageNo() . '', 0, 0, 'C');
    }
    function LoadData($file)
    {
        // Lecture des lignes du fichier
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(';',trim($line));

        return $data;
    }
    function FancyTable($header,$dat)
    {
        // Couleurs, épaisseur du trait et police grasse
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        // En-tête
        $w = array(40, 35, 45, 60);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        // Restauration des couleurs et de la police
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Données
        $fill = false;
       // foreach ($data as $row) {
            $this->Cell($w[0], 6, $dat[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $dat[1], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $dat[2], 'LR', 0, 'L', $fill);
            //$this->Cell($w[2], 6, number_format([2], 0, ',', ' '), 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, $dat[3], 'LR', 0, 'L', $fill);

            //$this->Cell($w[3], 6, date($row[3], 0), 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill;
       // }
        // Trait de terminaison
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

$bdd=new PDO("mysql:host=localhost;dbname=cv_generator;charset=utf8", "root", "");
$data=0;
$ecrire=fopen('pays.txt',"w");
$email = 'corentin.latimier@utbm.fr';
$sql=$bdd->prepare("SELECT  * FROM utilisateur WHERE email = ?");
$sql->execute([$email]);
$data=$sql->fetch();

//if ($dat!=false){
$dat[3]='\0';

    //$data =  $data['nom']. ';' . $data['prenom'].';'.'0'. $data['num_telephone'] . ';'. $data['adresse_actuelle']; //.$data['date_naissance'];
$dat[0]=$data['nom'];
$dat[1]=$data['prenom'];
$dat[2]=$data['num_telephone'];
$dat[3]=$data['adresse_actuelle'];


//}
//echo $data;
//$ecrire=fopen('pays.txt',"a+");
//fputs($ecrire,$data);
//fputs($ecrire,"\n");
$pdf = new PDF();
$header = array('nom', 'prenom', 'numero ', 'adresse');
// Chargement des données
//$data = $pdf->LoadData('pays.txt');
$pdf->SetFont('Arial','',14);
$pdf->AddPage();

$pdf->FancyTable($header,$dat);
$pdf->Output();