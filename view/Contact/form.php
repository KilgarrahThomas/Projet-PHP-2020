<?php
require './view/Partial/head.php';
?>
<div class="col-md-6">
    <h3>Contactez les Admins :</h3>
    <form action="<?php echo Router::GenerateRoute('ContactPost') ?>" method="post">
        <div class="form-group">
            <label for="mess">Votre message :</label>
            <textarea class="form-control" id="mess" name="mess" rows="5"><?=$Co->getMessage()?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
<?php require './view/Partial/footer.php' ?>
