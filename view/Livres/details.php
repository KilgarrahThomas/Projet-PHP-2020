<?php
require './view/Partial/head.php';
?>
    <div class="w-100">
        <img class="couv" src="./public/images/noBook.jpg" alt="couverture">
        <h3><?php echo $L->getTitre(); ?></h3>
        <p>Par <?php echo $L->getAuteur()->getNom(); ?> <?php echo $L->getAuteur()->getNom(); ?> - <?php echo $L->getGenre()->getNom(); ?></p>
        <p>Moyenne : <?=$L->getMoyenne()?></p>
        <p><?=$L->getSommaire()?></p>
    </div>

    <?php foreach ($C as $tmp){ ?>
        <div class="row w-100 d-flex flex-column comm">
            <p><?=$tmp->getLecteur()->getPrenom()?> a donné la note de <?=$tmp->getNote()?></p>
            <p><?=$tmp->getCommentaire()?></p>
        </div>
    <?php } ?>
<?php require './view/Partial/footer.php' ?>
