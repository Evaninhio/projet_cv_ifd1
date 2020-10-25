<?php
session_start();
header ("content-type: image/jpeg");
echo $_SESSION['photo_profil'];

?>
