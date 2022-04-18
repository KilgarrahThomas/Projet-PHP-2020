<?php
require './view/Partial/head.php';
?>
    <div class="col-md-6">
        <h3>S'inscrire</h3>
        <form action="<?php echo Router::GenerateRoute('NewClient') ?>" method="post"
              id="#ToValidate">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input class="form-control" type="text" name="nom" id="nom" value="<?=$_POST['nom']?>" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prenom :</label>
                <input class="form-control" type="text" name="prenom" id="prenom" value="<?=$_POST['prenom']?>" required>
            </div>
            <div class="form-group">
                <label for="mail">Mail :</label>
                <input class="form-control" type="text" name="mail" id="mail" value="<?=$_POST['mail']?>" required>
            </div>
            <div class="form-group">
                <label for="newMdp">Mot de passe :</label>
                <input class="form-control" type="password" name="newMdp" id="newMdp" required minlength="4">
            </div>
            <div class="form-group">
                <label for="newMdpValidation">Validation du mot de passe :</label>
                <input class="form-control" type="password" name="newMdpValidation" id="newMdpValidation" required>
            </div>
            <div class="form-group">
                <label for="dateNaiss">Date de Naissance</label>
                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" name="dateNaiss" id="dateNaiss"
                           value="<?=$_POST['dateNaiss']?>" data-target="#datetimepicker1"/>
                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>


    <script>
        window.addEventListener('load', function () {
            $('#datetimepicker1').datetimepicker({
                format: 'L',
                locale: 'fr'
            });
        });
    </script>

<?php require './view/Partial/footer.php' ?>