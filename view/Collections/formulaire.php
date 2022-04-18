<?php
require './view/Partial/head.php';
?>
<div class="col-md-6">
    <h3>Ajouter/modifier une note à <?php echo $C->getLivre()->getTitre(); ?></h3>
    <form action="<?php echo Router::GenerateRoute('CollectionPost') ?>" method="post">
        <input id="ClientID" name="ClientID" type="hidden" value="<?php echo $C->getClientID(); ?>">
        <input id="LivreID" name="LivreID" type="hidden" value="<?php echo $C->getLivreID(); ?>">
        <div class="form-group">
            <label for="note">Note :</label>
            <input class="form-control" type="number" name="note" id="note"
                   value="<?php echo $C->getIntNote(); ?>" min="0" max="20">
        </div>

        <div class="form-group">
            <label for="commentaire">Commentaire :</label>
            <textarea class="form-control" id="commentaire" name="commentaire" rows="5"><?=$C->getCommentaire()?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
<?php require './view/Partial/footer.php' ?>