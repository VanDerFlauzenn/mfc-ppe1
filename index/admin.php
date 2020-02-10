<?php
	if (isset($_POST['accept'])) {
		$sql_student = "UPDATE student_interested_in_formation SET registered = '1' WHERE id = '".$_POST['accept']."'";
		$result_student = mysqli_query($GLOBALS['conn'], $sql_student);
	} else if (isset($_POST['refuse'])) {
		$sql_student = "UPDATE student_interested_in_formation SET registered = '2' WHERE id = '".$_POST['refuse']."'";
		$result_student = mysqli_query($GLOBALS['conn'], $sql_student);
	} else if (isset($_POST['cancel'])) {
		$sql_student = "UPDATE student_interested_in_formation SET registered = '0' WHERE id = '".$_POST['cancel']."'";
		$result_student = mysqli_query($GLOBALS['conn'], $sql_student);
	}

	function createList($listName, $titles, $registered) {
?>

<div class="row justify-content-md-center">
  <div class="col mb-4 col-lg-8">
    <div class="admin-table card bg-light text-center">
  	  <div class="card-header"><?php echo $listName; ?></div>
      <div class="card-body">
      	<div class="row">
      		<?php
      			foreach ($titles as $titleIndex => $title) {
	      			echo "<h5 class='card-title col-lg'>".$title."</h5>";
	      		} 
      		?>
	      </div>
	      <?php
					$sql_user = "SELECT * FROM student_interested_in_formation WHERE registered = '".$registered."'";
					$result_user = mysqli_query($GLOBALS['conn'], $sql_user);

					while ($row_user = mysqli_fetch_array($result_user)) {
						$sql_student = "SELECT * FROM users WHERE id = '".$row_user['student_id']."'";
						$result_student = mysqli_query($GLOBALS['conn'], $sql_student);
						$row_student = mysqli_fetch_array($result_student);

						$sql_formation = "SELECT * FROM formations WHERE id = '".$row_user['formation_id']."'";
						$result_formation = mysqli_query($GLOBALS['conn'], $sql_formation);
						$row_formation = mysqli_fetch_array($result_formation);

						echo "
						<hr>
						<form method='POST' action='.'>
							<div class='row'>
								<span class='card-text col-lg'>".$row_student['username']."</span>
				        <span class='card-text col-lg'>".$row_formation['name']."</span>
				        <span class='card-text col-lg'>";
						if ($registered === "0") {
			        echo "<button type='submit' class='btn btn-success' value='".$row_user['id']."' name='accept'>Accepter</button>
			        			<button type='submit' class='btn btn-danger' value='".$row_user['id']."' name='refuse'>Refuser</button>";
						} else if ($registered === "1") {
					    echo "<button type='submit' class='btn btn-danger' value='".$row_user['id']."' name='cancel'>Annuler</button>";
						} else if ($registered === "2") {
					    echo "<button type='submit' class='btn btn-danger' value='".$row_user['id']."' name='cancel'>Annuler</button>";		
						}
						echo "
				        </span>
							</div>
						</form>";
					}
			?>
      </div>
    </div>
  </div>
</div>
<?php
	}

	createList("Liste des demandes d'inscription d'élèves", ['Élève', 'Formation', 'Actions'], '0');

	createList("Liste des demandes validées d'élèves", ['Élève', 'Formation', 'Actions'], '1');

	createList("Liste des demandes rejetées d'élèves", ['Élève', 'Formation', 'Actions'], '2');
?>