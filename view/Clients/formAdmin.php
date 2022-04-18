<?php
require './view/Partial/head.php';
?>
    <div class="col-md-6">
        <h3>Modifier un client</h3>
        <form action="<?php echo Router::GenerateRoute('ClientPost') ?>" method="post">
            <input id="ClientID" name="ClientID" type="hidden" value="<?php echo $C->getClientId(); ?>">
            <div class="form-group">
                <label for="nom">Nom : <?php echo $C->getNom(); ?></label>
            </div>
            <div class="form-group">
                <label for="prenom">Prenom : <?php echo $C->getPrenom(); ?></label>
            </div>
            <div class="form-group">
                <label for="mail">Prenom :</label>
                <input class="form-control" type="text" name="mail" id="mail"
                       value="<?php echo $C->getMail(); ?>">
            </div>
            <?php if(intval($this->Client->getLevel()) == Clients::LevelRoot)
            { ?>
                <div class="custom-control custom-switch form-group">
                    <input type="checkbox" class="custom-control-input" id="niveau" name="niveau" <?php if($C->getLevel() == 1) echo "checked"?>>
                    <label class="custom-control-label" for="niveau">Admin :</label>
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
<?php require './view/Partial/footer.php' ?>