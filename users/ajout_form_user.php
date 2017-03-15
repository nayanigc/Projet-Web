<div class="titre">Ajouter un personne</div>
            <form action="ajout_pers.php" method="post">
                <table>
                    <tr>
                        <td><label for="inputNom" class="control-label">Nom</label></td>
                            <td><input type="text" name="nom" class="form-control" id="inputNom" placeholder="nom" required value="<?= $data['nom']??""?>"></td>
                    </tr>
                    <tr> <td><label for="inputPrenom" class="control-label">Prenom</label></td>
                            <td><input type="text" name="prenom" class="form-control" id="inputPrenom" placeholder="prenom" required value="<?= $data['prenom']??""?>"></td>
                    </tr>
                     <div class="form-group">
                            <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </table>
          </form>