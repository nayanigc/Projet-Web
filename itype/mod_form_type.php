<?php
include("../header.php");
if(!isset($_GET['tid'])){
    echo "Erreur: tid non défini";
    echo "TID : " . $_GET['tid'];
}
?>

<div class="titre">Modifie le nom du type </div>
            <form action="mod_type.php?tid=<?php echo $_GET['tid'] ?>" method="post">

<table> 
        <tr>
                        <td><label for="inputNom" class="control-label">Nom</label></td>
                            <td><input type="text" name="nom" class="form-control" id="inputNom" placeholder="nom" required value="<?= $data['nom']??""?>"></td>
                    </tr>      <tr>
                </table>
                  <div class="form-group">
                            <button type="submit" class="btn btn-primary"> Valider</button>
                      
                    </div>
   <?php
    include("../footer.php");
                  ?>