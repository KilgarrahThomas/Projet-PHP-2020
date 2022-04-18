<?php
require './view/Partial/head.php';
?>
    <div class="row w-100 m-0">
        <div class="col">
            <p>Listing des Editions</p>
        </div>
        <div class="col-auto p-0">
            <form action="<?php echo Router::GenerateRoute('EditionEdit') ?>" method="post">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                        title="Modifier">
                    <i class="fas fa-plus-circle"></i>
                    Ajouter une Maison d'Edition
                </button>
            </form>
        </div>
    </div>
    <table id="DataTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Action</th>
            <th>Maisons d'Edition</th>

        </tr>
        </thead>
        <?php foreach ($Edition as $E) { ?>
            <tr>
                <td class="p-0">
                    <div class="btn-group" role="group">
                        <form action="<?php echo Router::GenerateRoute('EditionEdit') ?>" method="post">
                            <input id="EditionID" name="EditionID" type="hidden"
                                   value="<?php echo $E->getEditionID(); ?>">
                            <button type="submit" class="btn p-0  m-1" data-toggle="tooltip" data-placement="top"
                                    title="Modifier">
                                <i class="fas fa-edit dt-fa></i>
                            </button>
                        </form>
                        <form action="<?php echo Router::GenerateRoute('EditionDel') ?>" method="post">
                            <input id="EditionID" name="EditionID" type="hidden"
                                   value="<?php echo $E->getEditionID(); ?>">
                            <button type="submit" class="btn p-0  m-1" data-toggle="tooltip" data-placement="top"
                                    onclick="return(confirm('Etes-vous sûr de vouloir supprimer <?=$E->getMaisonEdition(); ?> ?'))";
                                    title="Supprimer">
                                <i class="fas fa-trash-alt dt-fa"></i>
                            </button>
                        </form>
                    </div>
                </td>
                <td><?php echo $E->getMaisonEdition(); ?></td>
            </tr>
        <?php } ?>
    </table>
<?php require './view/Partial/footer.php' ?>