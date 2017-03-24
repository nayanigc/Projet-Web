<?php

require("auth/EtreAuthentifie.php");

$title = 'Accueil'; 
include("header.php");
?>

<a href="<?= $pathFor['logout'] ?>" title="Logout">Logout</a>

<?php
     $_SESSION['uid'] = $idm->getUid();

echo "Hello " . $idm->getIdentity().". Your uid is: ". $idm->getUid() .". Your role is: ".$idm->getRole();
if ($idm->getRole() == 'admin'){
//echo "Escaped values: ".$e_($ci->idm->getIdentity());
include("users/liste_users.php");
include("pers/liste_pers.php");
include("itype/liste_type.php");
include("id/liste_id.php");
}
include("footer.php");