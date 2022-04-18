<?php
require './view/Partial/head.php';
?>
<div class="row w-100 m-0">
    <div class="col">
        <h3>Les messages</h3>
    </div>
    <div class="col-auto p-0">
        <a href="<?php echo Router::GenerateRoute('AllMessageDel') ?>"
            <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                    onclick="return(confirm('Etes-vous sûr de vouloir supprimer tous les messages reçus ?'))";
                <i class="fas fas fa-trash-alt"></i>
                Supprimer tous les messages
            </button>
        </a>
    </div>
</div>
<?php foreach ($Messages as $M) { ?>
<div class="row-md-6 comm">
    <form action="<?php echo Router::GenerateRoute('MessageDel') ?>" method="post">
        <input id="MessageID" name="MessageID" type="hidden"
               value="<?php echo $M->getId(); ?>">
        <p> <button type="submit" class="btn p-0  m-1" data-toggle="tooltip" data-placement="top"
                    onclick="return(confirm('Etes-vous sûr de vouloir supprimer le message de <?=$M->getClient()->getPrenom(); ?> ?'))";
                    title="Supprimer">
                <i class="fas fa-trash-alt dt-fa"></i>
            </button> Message de <?=$M->getClient()->getPrenom(); ?></p>
    </form>
    <p><?=$M->getMessage()?></p>
</div>
<?php }
require './view/Partial/footer.php' ?>
