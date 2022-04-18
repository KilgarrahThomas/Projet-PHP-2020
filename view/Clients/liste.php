<?php
require './view/Partial/head.php';
?>
    <div class="row w-100 m-0">
        <div class="col">
            <p>Listing des Clients</p>
        </div>
    </div>
    <table id="DataTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Action</th>
            <th>Client</th>
            <th>Mail</th>
            <th>Age</th>
            <?php if($this->Client->getLevel() == Clients::LevelRoot){ ?>
                <th>Niveau</th>
            <?php } ?>
        </tr>
        </thead>
        <?php foreach ($Clients as $C) {;?>
            <tr>
                <td class="p-0">
                    <div class="btn-group" role="group">
                        <form action="<?php echo Router::GenerateRoute('ClientEdit') ?>" method="post">
                            <input id="Client" name="ClientID" type="hidden"
                                   value="<?php echo $C->getClientId(); ?>">
                            <button type="submit" class="btn p-0  m-1" data-toggle="tooltip" data-placement="top"
                                    title="Modifier">
                                <i class="fas fa-edit dt-fa"></i>
                            </button>
                        </form>
                        <form action="<?php echo Router::GenerateRoute('ClientDel') ?>" method="post">
                            <input id="Client" name="ClientID" type="hidden"
                                   value="<?php echo $C->getClientId(); ?>">
                            <button type="submit" class="btn p-0  m-1" data-toggle="tooltip" data-placement="top" onclick="return(confirm('Etes-vous sûr de vouloir supprimer <?=$C->getNom().' '.$C->getPrenom()?> ?'))";
                                    title="Supprimer">
                                <i class="fas fa-trash-alt dt-fa"></i>
                            </button>
                        </form>
                    </div>
                </td>
                <td><?php echo $C->getNom().' '.$C->getPrenom(); ?></td>
                <td><?php echo $C->getMail() ?></td>
                <td><?php echo $C->getAge() ?></td>
                <?php if($this->Client->getLevel() == Clients::LevelRoot){ ?>
                    <td><?php echo Auth::getLevelNameByLevel($C->getLevel()) ?></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
<?php require './view/Partial/footer.php' ?>