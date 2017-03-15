<?php

require("auth/EtreAuthentifie.php");

$title = 'Accueil';
include("header.php");
?>

<a href="<?= $pathFor['logout'] ?>" title="Logout">Logout</a>

<?php
     $_SESSION['uid'] = $idm->getUid();
if ($idm->getRole()=='admis')
echo "Hello " . $idm->getIdentity().". Your uid is: ". $idm->getUid() .". Your role is: ".$idm->getRole();

//echo "Escaped values: ".$e_($ci->idm->getIdentity());
//include("liste.php");

include("footer.php");