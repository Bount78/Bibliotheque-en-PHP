<?php
ob_start() ?>

<div class="row">

    <div class="col-6">
        <img src="<?= URL ?>public/images/<?= $livre->getImage();?>" alt="Couverture du livre">
    </div>
    <div class="col-6">
        <h4>Titre : <?= $livre->getTitre();?></h4>
        <h5>Nombre de pages : <?= $livre->getnbPages();?></h5>
    </div>

</div>

<?php


$content = ob_get_clean();
$titre = $livre->getTitre();
require 'template.php';

?>