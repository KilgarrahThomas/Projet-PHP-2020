<?php
require './view/Partial/head.php';
?>
<div class="col-md-6">
    <h3>Ajouter/modifier un livre</h3>
    <form action="<?php echo Router::GenerateRoute('LivrePost') ?>" method="post">
        <input id="LivreID" name="LivreID" type="hidden" value="<?php echo $L->getLivreId(); ?>">
        <div class="form-group">
            <label for="titre">Titre :</label>
            <input class="form-control" type="text" name="titre" id="titre"
                   value="<?php echo $L->getTitre(); ?>">
        </div><div class="form-group">
            <label for="auteurID">Auteur :</label>
            <select class="select2 form-control" name="auteurID" id="auteurID">
                <?php
                foreach (Auteurs::all() as $Au) {
                    echo '<option value="' . $Au->getAuteurId() . '" ' . (($L->getAuteurId() == $Au->getAuteurId()) ? 'selected' : '') . ' >' . $Au->getNom() . ' ' . $Au->getPrenom(). '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="genreID">Genre :</label>
            <select class="select2 form-control" name="genreID" id="genreID">
                <?php
                foreach (Genres::all() as $Ge) {
                    echo '<option value="' . $Ge->getGenreId() . '" ' . (($L->getGenreId() == $Ge->getGenreId()) ? 'selected' : '') . ' >' . $Ge->getNom(). '</option>';
                }
                ?>
            </select>
        </div
        <div class="form-group">
            <label for="editionID">Maison d'Edition :</label>
            <select class="select2 form-control" name="editionID" id="editionID">
                <?php
                foreach (Editions::all() as $Ed) {
                    echo '<option value="' . $Ed->getEditionId() . '" ' . (($L->getEditionId() == $Ed->getEditionId()) ? 'selected' : '') . ' >' . $Ed->getMaisonEdition(). '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="resume">Resume :</label>
            <textarea class="form-control" id="resume" name="resume" rows="5"><?=$L->getSommaire()?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
<?php require './view/Partial/footer.php' ?>
