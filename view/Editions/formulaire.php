<?php
require './view/Partial/head.php';
?>
<div class="col-md-6">
    <h3>Ajouter/modifier une maison d'Edition</h3>
    <form action="<?php echo Router::GenerateRoute('EditionPost') ?>" method="post">
        <input id="EditionID" name="EditionID" type="hidden" value="<?php echo $E->getEditionId(); ?>">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input class="form-control" type="text" name="nom" id="nom"
                   value="<?php echo $E->getMaisonEdition(); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
<?php require './view/Partial/footer.php' ?>