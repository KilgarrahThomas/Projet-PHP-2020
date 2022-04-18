<?php
require './view/Partial/head.php';
?>
<div class="col-md-6">
    <h3>Ajouter/modifier un genre</h3>
    <form action="<?php echo Router::GenerateRoute('GenrePost') ?>" method="post">
        <input id="GenreID" name="GenreID" type="hidden" value="<?php echo $G->getGenreId(); ?>">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input class="form-control" type="text" name="nom" id="nom"
                   value="<?php echo $G->getNom(); ?>">
        </div><div class="form-group">
            <label for="parent">Genre parent :</label>
            <select class="select2 form-control" name="parent" id="parent">
                <option value=""></option>
                <?php
                foreach (Genres::allWithoutParent() as $parent) {
                    echo '<option value="' . $parent->getGenreId() . '" ' . (($G->getGenreParentId() == $parent->getGenreId()) ? 'selected' : '') . ' >' . $parent->getNom() . '</option>';
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
<?php require './view/Partial/footer.php' ?>