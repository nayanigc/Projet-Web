<?php

require("../auth/EtreAuthentifie.php");

?>
<div class="titre" style ="   width: 21%;
    position: relative;
    right: -40%;
    bottom: -25%;
	margin-top: 3%; ">
	<h4><b>Ajouter un type</b></h4> 
   <form action="ajout_type.php" method="post">
   <label for="inputNom" class="control-label">Nom</label>
   <input type="text" name="nom" class="form-control" id="inputNom" placeholder="nom" required value="<?= $data['nom']??""?>">
	   <div class="form-group">
         <button type="submit" class="btn btn-primary" style =" margin-top: 4%;">Valider</button>
                    </div>
                </form>
</div>
<?php (include"../footer.php"); ?>