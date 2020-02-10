<header>
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
	  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
		<a class="navbar-brand" href="./">MFC</a>
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
		  <li class="nav-item active">
			<a class="nav-link" href="./">Accueil <span class="sr-only">(current)</span></a>
			<?php
				if (($session_bool) && ($_SESSION['status'] === 'admin')) {
			?>
			<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Tables
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Tous les utilisateurs</a>
          <div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#">Élèves</a>
					<a class="dropdown-item" href="#">Formateurs</a>
        </div>
      </li>
			<?php
				}
			?>
		</ul>
		<form class="form-inline my-2 my-lg-0 buttons-connections">
			<?php 
				if ($session_bool) {
			?>
		  <button class="btn btn-purple my-2 my-sm-0" type="button" onclick="window.location.href = './deconnection';">Se déconnecter</button>
			<?php
				} else {
					if ($current_file_name !== "inscription.php") {
			?>
		  <button class="btn btn-purple my-2 my-sm-0" type="button" onclick="window.location.href = './inscription';">S'inscrire</button>
		  <?php
					}
					if ($current_file_name !== "connection.php") {
		  ?>
		  <button class="btn btn-purple my-2 my-sm-0" type="button" onclick="window.location.href = './connection';">Se connecter</button>
			<?php
					}
				}
			?>
		</form>
	  </div>
	</nav>
</header>