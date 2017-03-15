
<?php
include("../header.php");
if(!isset($_GET['uid'])){
    echo "Erreur: uid non défini";
    echo "UID : " . $_GET['uid'];
}
?>

<div class="titre">Modifie le mot  de passe </div>
            <form action="mod_user.php?uid=<?php echo $_GET['uid'] ?>" method="post">

<table> <!-- recode en bootstrap...-->
    <tr>
                        <td><label for="inputMDP" class="control-label">MDP</label></td>
                            <td><input type="password" name="mdp" class="form-control" id="inputMDP" placeholder="Mot de passe" required value=""></td>
                    </tr>
                    <tr>
                        <td><label for="inputMDP2" class="control-label">Répéter MDP</label></td>
                            <td><input type="password" name="mdp2" class="form-control" id="inputMDP" placeholder="Répéter le mot de passe" required value=""></td>
                    </tr>
                   
                </table>
                  <div class="form-group">
                            <button type="submit" class="btn btn-primary"> Valider</button>
                      
                    </div>
   <?php
    include("../footer.php");
                  ?>