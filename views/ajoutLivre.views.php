<?php
ob_start() ?>

<form method="post" action="<?=URL?>livres/av" enctype="multipart/form-data">
  <fieldset>
    <legend>Rentre tes informations</legend>
    <div class="form-group">
      <label for="titre" class="form-label mt-4">Titre : </label>
      <input type="text" class="form-control" id="titre"  name="titre">
    </div>
    <div class="form-group">
      <label for="nbPages" class="form-label mt-4">Nombre de pages : </label>
      <input type="number" class="form-control" id="nbPages"  name="nbPages">
    </div>
    <div class="form-group">
      <label for="image" class="form-label mt-4">Image : </label>
      <input class="form-control" type="file" id="image" name="image">
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Envoyer</button>
  </fieldset>
</form>

<?php

$content = ob_get_clean();
$titre = 'Ajout d\'un livre';
require 'template.php';

?>