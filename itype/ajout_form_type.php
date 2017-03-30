<?php
if(!isset($_GET['tid'])){
    include("liste_type.php");
} else {
    $tid = $_GET['tid'];
}
echo "VAR".row['tid'];
?>
<div class="titre">Ajouter un type </div>
            <form action="ajout_type.php" method="post">
                <table>
                    <tr>
                        <td><label for="inputNom" class="control-label">Nom</label></td>
                            <td><input type="text" name="nom" class="form-control" id="inputNom" placeholder="nom" required value="<?= $data['nom']??""?>"></td>
                    </tr>   
       
                </table>
        <div class="form-group">
         <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </form>
<?php include"../footer.php" ?>