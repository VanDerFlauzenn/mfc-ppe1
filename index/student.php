<label for="formationsList">Liste des formations disponibles proposées par MFC :</label>
<div class="row justify-content-md-center">
  <div class="col mb-4 col-lg-8">
    <div class="admin-table card bg-light text-center">
  	  <div class="card-header">Formations</div>
      <div class="card-body">
      	<div class="row">
	        <h5 class="card-title col-lg">Nom</h5>
	        <h5 class="card-title col-lg">Description</h5>
	        <h5 class="card-title col-lg">Actions</h5>
	      </div>
	      <?php
					$sql_formations = "SELECT * FROM formations";
					$result_formations = mysqli_query($GLOBALS['conn'], $sql_formations);

					while ($row_formations = mysqli_fetch_array($result_formations)) {
						echo "<hr>
						<div class='row'>
							<form class='col-md-12 row' method='POST' action='inscription/formation'>
				        <span class='card-text col-lg'>".$row_formations['name']."</span>
				        <span class='card-text col-lg'>".$row_formations['description']."</span>
				        <span class='card-text col-lg'>
					        <button type='submit' class='btn btn-success' value='".$row_formations['id']."' name='formation'>S'inscrire</button>
				        </span>
				       </form>
						</div>";
					}
			?>
      </div>
    </div>
  </div>
</div>

<!-- TODO:
-Selon l'option selectionnee on affiche un autre select avec des etablissements
-Selon l'etablissement selectionne on affiche les infos : (planning/parkings/etcs...) et puis un bouton pour s'inscrire -->