<?php

require("auth/EtreAuthentifie.php");

$title = 'Accueil';
include("header.php");

$_SESSION['uid'] = $idm->getUid();

	
if($idm->getRole() == 'user'){
	include("navbar.php");
	include("mise_en_page2.php");	
	include("pointage/even_pointage.php"); //?uid=$_SESSION[uid]
}
	
if ($idm->getRole() == 'admin'){
	include("navbar2.php");
	include("mise_en_page2.php");
    include("mise_en_page.php");

}

include("footer.php");
?>