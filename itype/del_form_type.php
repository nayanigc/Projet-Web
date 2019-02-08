<?php
require("../auth/EtreAuthentifie.php");
?>
<div class="titre" style ="   width: 21%;
    position: relative;
    right: -40%;
    bottom: -25%;
	margin-top: 15%; ">
<p>Etes vous sur?
<form method="post">
  <input type="submit" name="supprimer" value="Supprimer">
  <input type="submit" name="annuler" value="Annuler">
</form>

<?php include("../footer.php"); ?>