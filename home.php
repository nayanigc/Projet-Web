<?php

require("auth/EtreAuthentifie.php");

$title = 'Accueil'; 
include("header.php");

$_SESSION['uid'] = $idm->getUid();

include("mise_en_page2.php");

if($idm->getRole() == 'user'){
	?>
	<a href="pointage/even_pointage.php?uid= $idm->getUid()">connexion vers pointage</a>;
<?php
}
	
if ($idm->getRole() == 'admin'){
    include("mise_en_page.php");

}

include("footer.php");
?>