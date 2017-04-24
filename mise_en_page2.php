<html>
	<link rel="stylesheet" href="styles.css"/>

   <header class="headerPage">
          <h2 class="titre">  
			  <?php 
			  	echo "Hello ".$idm->getIdentity().". Your uid is: ".$idm->getUid().". Your role is:     ".$idm->getRole();  
			  ?></h2>
    </header>
	
</html>