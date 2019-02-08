
<?php
require("../auth/EtreAuthentifie.php");
include("../header.php");
if(!isset($_GET['uid'])){
    echo "Erreur: uid non défini";
    echo "UID : " . $_GET['uid'];
}
?>
<style>
	.titre{
	    width: 17%;
    	position: relative;
    	right: -38%;
    	margin-top: 15%;
	}
</style>
<div class="titre">
	<h4><b>Modifie le mot  de passe</b></h4> 
   <form action="mod_user.php?uid=<?php echo $_GET['uid'] ?>" method="post">
	   <label for="inputMDP" class="control-label">Nouveau mot de passe</label>
       <input type="password" name="mdp" class="form-control" id="inputMDP" placeholder="Mot de passe" required value="">
	   <label for="inputMDP2" class="control-label">Confirmer mot de passe</label>
	   <input type="password" name="mdp2" class="form-control" id="inputMDP" placeholder="Répéter le mot de passe" required value="">
	   <button type="submit" class="btn btn-primary" style="margin-top:5%;"> Valider </button>
 	</form>
</div>
<?php
   include("../footer.php");
?>