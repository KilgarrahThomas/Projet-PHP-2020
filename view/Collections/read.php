<?php
require './view/Partial/head.php';
?>
    <div class="row w-100 m-0">
        <div class="col">
            <p>Les livres que vous avez lus</p>
        </div>
    </div>
    <table id="DataTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Action</th>
            <th>Titre</th>
            <th>Genre</th>
            <th>Auteur</th>
            <th>Note</th>
        </tr>
        </thead>
        <?php foreach ($Collection as $C) {;?>
            <tr>
                <td class="p-0">
                    <div class="btn-group" role="group">
                        <form action="<?php echo Router::GenerateRoute('CollectionNote') ?>" method="post">
                            <input id="LivreID" name="LivreID" type="hidden"
                                   value="<?php echo $C->getLivreId(); ?>">
                            <input id="ClientID" name="ClientID" type="hidden"
                                   value="<?php echo $C->getClientId(); ?>">
                            <button type="submit" class="btn p-0  m-1" data-toggle="tooltip" data-placement="top"
                                    title="Noter">
                                <i class="fas fa-edit dt-fa"></i>
                            </button>
                        </form>
                        <form action="<?php echo Router::GenerateRoute('CollectionDel') ?>" method="post">
                            <input id="LivreID" name="LivreID" type="hidden"
                                   value="<?php echo $C->getLivreId(); ?>">
                            <input id="ClientID" name="ClientID" type="hidden"
                                   value="<?php echo $C->getClientId(); ?>">
                            <button type="submit" class="btn p-0  m-1" data-toggle="tooltip" data-placement="top" onclick="return(confirm('Etes-vous sûr de vouloir supprimer <?=$C->getLivre()->getTitre()?> de votre collection ?'))";
                                    title="Supprimer">
                                <i class="fas fa-trash-alt dt-fa"></i>
                            </button>
                        </form>
                    </div>
                </td>
                <td><?php echo $C->getLivre()->getTitre(); ?></td>
                <td><?php echo $C->getLivre()->getGenre()->getNom()?></td>
                <td><?php echo $C->getLivre()->getAuteur()->getNom().' '.$C->getLivre()->getAuteur()->getPrenom(); ?></td>
                <td><?php echo $C->getNote(); ?></td>
            </tr>
        <?php } ?>
    </table>
<?php require './view/Partial/footer.php' ?>