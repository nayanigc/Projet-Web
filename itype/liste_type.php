
<?php
$page_title ="Liste type";
include("../header.php");
include("type.php");
require("../db_config.php");
try{
    
    $db = new PDO("mysql:hostname=$hostname;dbname=$dbname",$username);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $SQL="SELECT * FROM itypes";
    $res =$db->query($SQL);
        if ($res->rowCount()==0){
        echo"<p>La liste est vide";
            ?>
<div class="ajouter" title="Ajouter une type"><a class="a" href='ajout_form_type.php?tid=<?php echo $row['tid'] ?>'>Ajouter</a></div>
        
        <?php
    }else{
    ?>

    <style>
		table {border-collapse: collapse}
        td,th {border: 1px solid black}
    </style>
	
	<table class="table table-striped">
	<thead>
		<th>Nom</th>
		<th>Modifier</th>	
		<th>Supprimer</th>

	</thead> 
<?php
 while($row=$res->fetch()){
     ?>
    <tr>
       <td><?php echo htmlspecialchars($row['nom'])?></td>
       <td><a href='mod_form_type.php?tid=<?php echo $row['tid'] ?>'>Modifie</a></td>
       <td><a href='sup_type.php?tid=<?php echo $row['tid'] ?>'>Supprimer</a></td>
    </tr>
    
                       
<?php
        };
echo "</table>\n";
?>
	</table>
   <div class="ajouter" title="Ajouter une type"><a class="a" href='ajout_form_type.php?tid=<?php echo $row['tid'] ?>'>Ajouter</a></div>
<?php
            $db = null;
 };
}catch (PDOException $e){
    echo"Erreur SQL:".$e->getMessage();
}
include("../footer.php");
?>