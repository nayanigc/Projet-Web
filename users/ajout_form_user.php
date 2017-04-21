<div class="titre" style="
    width: 21%;
    position: relative;
    right: -40%;
    bottom: -25%;
">
	<h4><b>Ajouter un personne</b></h4>
    <form action="ajout_users.php" method="post">
	    <label for="inputNom" class="control-label">Login</label>
        <input type="text" name="login" class="form-control" id="inputLogin" placeholder="login" required value="<?= $data['login']??""?>">
        <label for="inputMDP" class="control-label">MDP</label>
        <input type="password" name="mdp" class="form-control" id="inputMDP" placeholder="Mot de passe" required value="">
        <label for="inputMDP2" class="control-label">Confirmer MDP</label>
        <input type="password" name="mdp2" class="form-control" id="inputMDP" placeholder="Répéter le mot de passe" required value=""/>
        <button type="submit" class="btn btn-primary" style="margin-top:2.5%;"> Valider</button>      

<?php
include("../footer.php");
?>