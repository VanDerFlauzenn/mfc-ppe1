<?php
    require_once("./db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>MFC - Formations</title>
	<?php
		include('./head.php');
	?>
</head>
<body>
  <form>
        <div class="form-row">
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label for="status">Êtes-vous étudiant ou formateur ?</label>
            <div id="status">
              <label class="btn btn-primary active">
                <input type="radio" name="options" id="student" checked> Étudiant
              </label>
              <label class="btn btn-primary">
                <input type="radio" name="options" id="former"> Formateur
              </label>
            </div>
              <label class="btn btn-primary">
                <input type="radio" name="options" id="former"> Formateur
              </label>
          </div>
        </div>
  </form>
</body>
</html>