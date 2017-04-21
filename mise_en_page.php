
<link rel="stylesheet" href="styles.css"/>
 
<div id="row">
<div  class="col-lg-2"> 
<a onmouseenter="changerFond('url(per.jpg)')"
   onmouseout="changerFond('')" href="pers/liste_pers.php">Afficher la liste des personnes<br/></a>
				 
<a  href="users/liste_users.php">Afficher la liste des utilisateurs <br/></a>
		  
 <a href="eve/liste_even.php">Afficher la liste des evenements <br/></a>
		  
 <a  href="itype/liste_type.php">Afficher la liste des types <br/></a>
		
 <a href="eve/liste_cat.php">Afficher la liste des catégories <br/></a>
	
<a   href="part/list_part.php">Afficher la liste des participations <br/></a>
	
<a  href="insc/liste_ins.php">Pour inscrire a des evenements<br/></a>
</div>
</div>

<script>
   var elt = document.getElementById('body');
   function changerFond(pram){
	   elt.style.backgroundImage=pram;
   }
	
   function changerFond1(){
	   elt.style.backgroundImage='url("home.jpg")';
   }
 		
</script>

</html>