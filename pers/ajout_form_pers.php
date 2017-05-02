<?php 
session_start();
?>

<div class="titre" style="
	width: 21%;
    position: relative;
    right: -40%;
    bottom: -25%;
						  "> 
			<h4><b>Ajouter une personne  </b></h4>
    <form action="ajout_pers.php" method="post">
		<div>
       <label for="inputNom" class="control-label">Nom</label>
       <input type="text" name="nom" class="form-control" id="inputNom" placeholder="nom" required value="<?= $data['nom']??""?>">
       <label for="inputPrenom" class="control-label">Prenom</label>
		</div>
 <input type="text" name="prenom" class="form-control" id="inputPrenom" placeholder="prenom" required value="<?= $data['prenom']??""?>">
		
 <button type="submit" class="btn btn-primary">Valider</button>
                    
</form>
</div>
<?php
include("../footer.php");
?>