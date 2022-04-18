<?php
require './view/Partial/head.php';
?>
    <div class="col-md-6">
        <h3>Se connecter</h3>
        <form action="<?php echo Router::GenerateRoute('ConnexionPost') ?>" method="post">

            <div class="form-group">
                <label for="login">Adresse mail :</label>
                <input class="form-control" type="text" name="login" id="login" maxlength="30" value="" required >
            </div>
            <div class="form-group">
                <label for="mdp">Mot de passe :</label>
                <input class="form-control" type="password" name="mdp" id="mdp" required>
            </div>
            <div class="custom-control custom-switch form-group">
                <input type="checkbox" class="custom-control-input" id="remeberMe" name="remeberMe">
                <label class="custom-control-label" for="remeberMe">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary">Connexion</button>
        </form>
    </div>
<?php require './view/Partial/footer.php' ?>