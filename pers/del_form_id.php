<?php
require("../auth/EtreAuthentifie.php");
?>
<p>Etes vous sur?
<form action= "sup_id.php?pid=<?php echo $_GET['pid'] ?>&tid=<?php echo $_GET['tid'] ?>" method="post">
  <input type="submit" name="supprimer" value="Supprimer">
  <input type="submit" name="annuler" value="Annuler">
</form>