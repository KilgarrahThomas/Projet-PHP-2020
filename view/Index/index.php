<?php
require './view/Partial/head.php';
?>
        <h3>Bienvenue <?=$this->Client->getPrenom()?> !</h3>
        <p>L'aile est actuellement en cours de construction.</p>
        <p>Merci de prendre patience. Nous ouvrirons bientôt</p>
<?php var_dump($this->Client); ?>
<?php require './view/Partial/footer.php' ?>