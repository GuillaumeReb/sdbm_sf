<?php

if (isset($_GET['Message'])) {
  $text = $_GET['Message'];
  $Message = "<div class='alert alert-danger alert-dismissible'>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        $text
      </div>";
}
$Titre = "Erreur";
require("view/header-tpl.php");
// echo @$Contenu;
require("view/footer-tpl.php");