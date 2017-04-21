<?php
include("../header.php");
?>

<div class="titre" style="
	width: 21%;
    position: relative;
    right: -40%;
    bottom: -25%;
	margin-top: 15%; ">
	<h4><b>Modifie le nom du type</b></h4>
    <form action="mod_id.php?pid=<?php echo $_GET['pid'] ?>&tid=<?php echo $_GET['tid'] ?>" method="post">

		<label for="inputValeur" class="control-label">Valeur</label>
		<input type="text" name="valeur" class="form-control" id="inputValeur" placeholder="valeur" required value="<?= $data['valeur']??""?>">
        <div class="form-group">
        <button type="submit" class="btn btn-primary"> Valider</button>
                      
		</div>
	</form>
</div>
   <?php
    include("../footer.php");
                  ?>