<?php
ob_start() ?>

<h1 style="text-align: center">Bienvue dans la boutique !</h1>

<?php

$content = ob_get_clean();
$titre = 'La boutique de livres';
require 'template.php';

?>