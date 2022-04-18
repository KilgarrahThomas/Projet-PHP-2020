<?php
setlocale(LC_TIME, "fra_FRA");
// On charge tout les fichiers nessesaire au fonctionement de l'application
require_once '../framework/Tools.php';
Tools::requireOnceFolder('../framework');
Tools::requireOnceFolder('../controller');
Tools::requireOnceFolder('../model');

// On start la session apres le chargement des element pour permetre de mettre des model dans session
session_name("MonPrinceBleuDAmour");
session_start();

set_exception_handler(function ($exception) {
    echo "Uncaught exception: ", $exception->getMessage(), "\n";
});

Router::run();
