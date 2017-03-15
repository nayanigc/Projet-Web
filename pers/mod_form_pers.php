<?php
include("header.php");
if(!isset($_GET['pid'])){
    echo "Erreur: pid non défini";
    echo "PID : " . $_GET['pid'];
}
?>

<div class="titre">Modifie le mot  de passe </div>
            <form action="mod_pers.php?pid=<?php echo $_GET['pid'] ?>" method="post">

<table> 
        <tr>
                        <td><label for="inputNom" class="control-label">Nom</label></td>
                            <td><input type="text" name="nom" class="form-control" id="inputNom" placeholder="nom" required value="<?= $data['nom']??""?>"></td>
                    </tr>      <tr>
                        <td><label for="inputPrenom" class="control-label">Prenom</label></td>
                            <td><input type="text" name="prenom" class="form-control" id="inputPrenom" placeholder="prenom" required value="<?= $data['prenom']??""?>"></td>
                    </tr>
                   
                </table>
                  <div class="form-group">
                            <button type="submit" class="btn btn-primary"> Valider</button>
                      
                    </div>
   <?php
    include("footer.php");
                  ?>