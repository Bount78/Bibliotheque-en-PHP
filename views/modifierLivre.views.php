<?php
ob_start() ?>


<form method="post" action="<?=URL?>livres/mv" enctype="multipart/form-data">
  <fieldset>
    <legend>Rentre tes informations</legend>
    <div class="form-group">
      <label for="titre" class="form-label mt-4">Titre : </label>
      <input type="text" class="form-control" id="titre"  name="titre" value="<?= $livre->getTitre(); ?>">
    </div>
    <div class="form-group">
      <label for="nbPages" class="form-label mt-4">Nombre de pages : </label>
      <input type="number" class="form-control" id="nbPages"  name="nbPages" value="<?= $livre->getnbPages(); ?>">
    </div>
    <h3>Images : </h3>
    <img src="<?= URL ?>public/images/<?= $livre->getImage() ?>" >
    <div class="form-group">
      <label for="image" class="form-label mt-4">Changer l'image : </label>
      <input class="form-control" type="file" id="image" name="image">
    </div>
    <input type="hidden" name="identifiant" value="<?= $livre->getId();?>">
    <br>
    <button type="submit" class="btn btn-primary">Envoyer</button>
  </fieldset>
</form>

<?php

$content = ob_get_clean();
$titre = 'Modification du livre : '.$livre->getId();
require 'template.php';

?>