<?php
ob_start() ?>

<?= $msg; ?>

<?php

$content = ob_get_clean();
$titre = 'Il doit y avoir une erreur';
require 'template.php';

?>