<?php
require './view/Partial/head.php';
?>
    <div class="col-md-6">
        <h3>Changement de mot de passe</h3>
        <form action="<?php echo Router::GenerateRoute('PWDPost') ?>" method="post"
              id="#ToValidate">
            <div class="form-group">
                <label for="oldMdp">Ancient mot de passe :</label>
                <input class="form-control" type="password" name="oldMdp" id="oldMdp" required>
            </div>
            <div class="form-group">
                <label for="newMdp">Nouveau mot de passe :</label>
                <input class="form-control" type="password" name="newMdp" id="newMdp" required minlength="4">
            </div>
            <div class="form-group">
                <label for="newMdpValidation">Validation du mot de passe :</label>
                <input class="form-control" type="password" name="newMdpValidation" id="newMdpValidation" required>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
<?php require './view/Partial/footer.php' ?>