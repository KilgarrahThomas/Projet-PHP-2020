<?php
require './view/Partial/head.php';
?>
<div class="col-md-6">
    <h3>Ajouter/modifier un auteur</h3>
    <form action="<?php echo Router::GenerateRoute('AuteurPost') ?>" method="post">
        <input id="AuteurID" name="AuteurID" type="hidden" value="<?php echo $A->getAuteurId(); ?>">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input class="form-control" type="text" name="nom" id="nom"
                   value="<?php echo $A->getNom(); ?>">
        </div><div class="form-group">
            <label for="nom">Prénom :</label>
            <input class="form-control" type="text" name="prenom" id="prenom"
                   value="<?php echo $A->getPrenom(); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
<?php require './view/Partial/footer.php' ?>