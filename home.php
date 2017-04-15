<?php

require("auth/EtreAuthentifie.php");

$title = 'Accueil'; 
include("header.php");

$_SESSION['uid'] = $idm->getUid();
include("mise_en_page2.php");
//echo "Hello " . $idm->getIdentity().". Your uid is: ". $idm->getUid() .". Your role is: ".$idm->getRole();
if ($idm->getRole() == 'admin'){
//echo "Escaped values: ".$e_($ci->idm->getIdentity());
    include("mise_en_page.php");
}?>

<div class="deconnexion"><a href="<?= $pathFor['logout'] ?>" title="Logout" style="color:white">Logout</a></div>

<?php
include("footer.php");
?>