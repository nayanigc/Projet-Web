<?php

$page_title="Liste evenement";
include("../header.php");
include("navbar.php");
include("eve.php");
require("../db_config.php");
try{
    $db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $SQL="SELECT * FROM evenements INNER  JOIN categories ON evenements.cid = categories.cid";
    $res=$db->query($SQL);
	
	$SQL1= "SELECT * FROM personnes";
		$req=$db->query($SQL1);
	$SQL2= "SELECT * FROM users";
		$ret=$db->query($SQL2);
    if($res->rowCount()==0 || $req->rowCount()==0 || $ret->rowCount()==0){
        echo"<P>La liste est vide";
?>
<div class="ajouter" title="Ajouter un evenement"><a class="a" href='ajout_form_even.php'>Ajouter</a></div>
<?php
    }else{
?>
    <table>
        <style> table {border-collapse:collapse;
			}
        </style>
		<table class="table table-striped"style="margin-right: 28%;">
	<thead>
		<th>Titre</th>
		<th>Description</th>
		<th>Date de debut</th>
		<th>Date de Fin</th>
		<th>Type</th>
		<th>Ajouter</th>
		<th>Modifier</th>
		<th>Supprimer</th>
		<th>Consulter</th>
	</thead>
		
<?php
    while(($row=$res->fetch())&& ($raw=$req->fetch()) && ($ruw=$ret->fetch())){
?>
    <tr>
	<td><?php echo htmlspecialchars($row['intitule']) ?> </td>
    <td><?php echo htmlspecialchars($row['description']) ?></td>
        <td><?php echo htmlspecialchars($row['dateDebut']) ?></td>
        <td><?php echo htmlspecialchars($row['dateFin']) ?></td>
        <td><?php echo htmlspecialchars($row['type']) ?></td>
      
		<td><a href='../pointage/ajout_form_ins.php?eid=<?php echo $row['eid'] ?>'>Ajoute une inscription</a></td>
        <td><a href='mod_form_eve.php?eid=<?php echo $row['eid'] ?>'>Modifie un evenement</a></td>
           <td><a href='sup_eve.php?eid=<?php echo $row['eid'] ?>'>Supprimer</a></td>
           <td><a href='info_eve_ins.php?eid=<?php echo $row['eid'] ?>'>Information sur l'evenement</a></td>
     

          </tr>
<?php      
    };
    echo "</table>\n";
    ?>
		</table>
<div class="ajouter" title="Ajouter un evenement"><a class="a" href='ajout_form_even.php?eid=<?php echo $row['eid'] ?>'>Ajouter</a></div>
<?php
    $db=null;
     };
        }catch(PDOException $e){
        echo "Erreur SQL:".$e->getMessage();
        }

include("../footer.php"); 
?>
