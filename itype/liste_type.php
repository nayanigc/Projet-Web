
<?php
$page_title ="Liste type";
include("header.php");
require("db_config.php");
try{
    
    $db = new PDO("mysql:hostname=$hostname;dbname=$dbname",$username);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $SQL="SELECT * FROM itypes";
    $res =$db->query($SQL);
        if ($res->rowCount()==0){
        echo"<p>La liste est vide";
            ?>
             <td><a href='itype/ajout_form_type.php?tid=<?php echo $row['tid'] ?>'>Ajouter</a></td>
        <?php
    }else{
    ?>
<table>
    <style>table {border-collapse: collapse}
        td,th {border: 1px solid black}
    </style>
<?php
 while($row=$res->fetch()){
     ?>
    <tr>
    <td> Nom: <?php echo htmlspecialchars($row['nom'])?></td>
      <td><a href='itype/mod_form_type.php?tid=<?php echo $row['tid'] ?>'>Modifie</a></td>
        <td><a href='itype/sup_type.php?tid=<?php echo $row['tid'] ?>'>Supprimer</a></td>
    </tr>
    
                       
<?php
        };
echo "</table>\n";
?>
      <td><a href='itype/ajout_form_type.php?tid=<?php echo $row['tid'] ?>'>Ajouter un type </a></td>
<?php
            $db = null;
 };
}catch (PDOException $e){
    echo"Erreur SQL:".$e->getMessage();
}
include("footer.php");
?>