<?php
require './view/Partial/head.php';
?>
<div class="col-md-6">
    <h3>Ajouter/modifier un niveau de visibilité</h3>
    <form action="<?php echo Router::GenerateRoute('VisibilitePost') ?>" method="post">
        <input id="visibilityID" name="visibilityID" type="hidden" value="<?php echo $V->getVisibilityID(); ?>">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input class="form-control" type="text" name="nom" id="nom"
                   value="<?php echo $V->getNom(); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
<?php require './view/Partial/footer.php' ?>