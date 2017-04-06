<?php
include("../header.php");
?>

<div class="titre">Modifie le nom du type </div>
            <form action="mod_id.php?pid=<?php echo $_GET['pid'] ?>&tid=<?php echo $_GET['tid'] ?>" method="post">

<table> 
        <tr>
                         <td><label for="inputValeur" class="control-label">Valeur</label></td>
                            <td><input type="text" name="valeur" class="form-control" id="inputValeur" placeholder="valeur" required value="<?= $data['valeur']??""?>"></td>
                    </tr> 

                </table>
                  <div class="form-group">
                            <button type="submit" class="btn btn-primary"> Valider</button>
                      
                    </div>
   <?php
    include("../footer.php");
                  ?>