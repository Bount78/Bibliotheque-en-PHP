<?php

ob_start();

if(!empty($_SESSION['alert'])) :
?>

<div class="alert alert-<?=$_SESSION['alert']['type'] ?>" role="alert">
<?=$_SESSION['alert']['msg'] ?>
</div>

<?php endif; ?>

<table class="table text-center">
    <tr class="table-dark">
        <th>Image</th>
        <th>Titre</th>
        <th>Nombre de pages</th>
        <th colspan="2">Les actions</th>
    </tr>
    <?php
    for ($i = 0; $i < count($livre); $i++) : ?>
        <tr>
            <td class="align-middle"><img src="public/images/<?= $livre[$i]->getImage(); ?>" width="150px;"></td>
            <td class="align-middle"><a href="<?= URL ?>livres/l/<?= $livre[$i]->getId() ?>"><?= $livre[$i]->getTitre(); ?></a></td>
            <td class="align-middle"><?= $livre[$i]->getnbPages(); ?></td>
            <td class="align-middle"><a href="<?= URL ?>livres/m/<?= $livre[$i]->getId(); ?>" 
            class="btn btn-warning">Modifier</a></td>
            <td class="align-middle">
                <form action="<?= URL ?>livres/s/<?= $livre[$i]->getId(); ?>" 
                onsubmit="return confirm('Tu veux vraiment supprimer le livre ?');" 
                method="post">
                <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
        </tr>
    <?php endfor; ?>
</table>
<a href="<?= URL ?>livres/a" class="btn btn-success d-block">Ajouter</a>

<?php

$content = ob_get_clean();
$titre = 'Les livres à découvrir';
require 'template.php';

?>