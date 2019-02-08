<?php
$title="Authentification";
include("header.php");
echo "<p class=\"error\">".($error??"")."</p>";
?>
<br /><br /><br /><br /><br /><br /><br /><br />
<div class="row">
	<div class="col-lg-4">
	</div>
	<div class="col-lg-4">
		<form method="post">
			<h2>Authentifiez-vous</h2>
			<div class="form-group">
			  <label for="inputNom" class="control-label">Login</label>
			  <input type="text" name="login" size="20" class="form-control" id="inputLogin" required placeholder="login"
										   required value="<?= $data['login']??"" ?>">
			</div>
			<div class="form-group">
			  <label for="inputMDP" class="control-label">MDP</label>
			  <input type="password" name="password" size="20" class="form-control" required id="inputMDP"
										   placeholder="Mot de passe">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Connexion</button>
				<span class="pull-center"><a href="<?= $pathFor['adduser'] ?>">   S'enregistrer</a></span>
			</div>
		</form>
	</div>
	<div class="col-lg-4">
	</div>
</div>

<?php

include("footer.php");
									   
?>