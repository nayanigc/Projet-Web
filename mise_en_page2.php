<html>
	<link rel="stylesheet" href="styles.css"/>

   <header class="headerPage">
	  <img src="home2.jpg" alt="Bootstrap" class="logo">
          <h2 class="titre">  
			  <?php 
			  	echo "Hello ".$idm->getIdentity().". Your uid is: ".$idm->getUid().". Your role is:     ".$idm->getRole();  
			  ?></h2>
	   <div class="deconnexion"><a href="<?= $pathFor['logout'] ?>" title="Logout" style="color:white">Logout</a></div>
    </header>
	
</html>