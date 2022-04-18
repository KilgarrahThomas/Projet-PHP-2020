<?php
require './view/Partial/head.php';
?>
    <div class="row w-100 m-0">
        <div class="col">
            <p>Listing des Auteurs</p>
        </div>
        <div class="col-auto p-0">
            <form action="<?php echo Router::GenerateRoute('AuteurEdit') ?>" method="post">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                        title="Modifier">
                    <i class="fas fa-plus-circle"></i>
                    Ajouter un auteur
                </button>
            </form>
        </div>
    </div>

    <table id="DataTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Action</th>
            <th>Auteurs</th>
        </tr>
        </thead>
        <?php foreach ($Auteur as $A) { ?>
            <tr>
                <td class="p-0">
                    <div class="btn-group" role="group">
                        <form action="<?php echo Router::GenerateRoute('AuteurEdit') ?>" method="post">
                            <input id="AuteurID" name="AuteurID" type="hidden"
                                   value="<?php echo $A->getAuteurID(); ?>">
                            <button type="submit" class="btn p-0  m-1" data-toggle="tooltip" data-placement="top"
                                    title="Modifier">
                                <i class="fas fa-edit dt-fa"></i>
                            </button>
                        </form>
                        <form action="<?php echo Router::GenerateRoute('AuteurDel') ?>" method="post">
                            <input id="AuteurID" name="AuteurID" type="hidden"
                                   value="<?php echo $A->getAuteurID(); ?>">
                            <button type="submit" class="btn p-0  m-1" data-toggle="tooltip" data-placement="top"
                                    onclick="return(confirm('Etes-vous sûr de vouloir supprimer <?=$A->getNom().' '.$A->getPrenom()?> de la liste des auteurs ?'))";
                                    title="Modifier">
                                <i class="fas fa-trash-alt dt-fa"></i>
                            </button>
                        </form>
                    </div>
                </td>
                <td><?php echo $A->getPrenom().' '.$A->getNom(); ?></td>
            </tr>
        <?php } ?>
    </table>
<?php require './view/Partial/footer.php' ?>