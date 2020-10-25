<?php

session_start();

header ("content-type: image/png");
echo $_SESSION['photo_profil'];

?>