<?php
require("../auth/EtreAuthentifie.php");
?>
<link rel="stylesheet" href="style.css"/>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">SmartEvent</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="../home.php">Home<span class="sr-only">(current)</span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Liste<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li> <a href="../part/list_part.php"s>Participation</a></li>
            <li><a href="../itype/liste_type.php">Type</a></li>
              <li><a href="../pers/liste_pers.php">Personne</a></li>
			  <li><a href="../eve/liste_cat.php">Categorie</a></li>
			  <li><a href="../eve/liste_even.php">Evenement</a></li>
          </ul>
        </li>
       <ul class="nav navbar-nav navbar-right">
		   
		<li><a href="<?= $pathFor['logout'] ?>" class="droite">Logout</a></li>
		  </ul>
		</ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>