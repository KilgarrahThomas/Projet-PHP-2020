<?php
require './view/Partial/head.php';
?>
    <div class="row w-100 m-0">
        <div class="col-1">

        </div>
        <div class="col">
            <h3 class="row">La bibliothèque</h3>
            <div class="row d-flex">
                <?php foreach ($Livre as $L) {;?>
                    <div class="card m-1" style="width: 18rem;">
                        <img class="card-img-top" src="./public/images/noBook.png" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $L->getTitre(); ?></h5>
                            <p class="card-text">Par <?php echo $L->getAuteur()->getNom(); ?> <?php echo $L->getAuteur()->getNom(); ?> - <?php echo $L->getGenre()->getNom(); ?></p>
                            <div class="btn-group card-group" role="group">
                                <form action="<?php echo Router::GenerateRoute('LivreDetail') ?>" method="post">
                                    <input id="LivreID" name="LivreID" type="hidden"
                                           value="<?php echo $L->getLivreId(); ?>">
                                    <button type="submit" class="btn p-0  m-1" data-toggle="tooltip" data-placement="top"
                                            title="Fiche">
                                    <i class="fas fa-search card-fa"></i>
                                    </button>
                                </form>
                                <form action="<?php echo Router::GenerateRoute('CollectionLu') ?>" method="post">
                                    <input id="LivreID" name="LivreID" type="hidden"
                                           value="<?php echo $L->getLivreId(); ?>">
                                    <button type="submit" class="btn p-0  m-1" data-toggle="tooltip" data-placement="top"
                                            title="Indiquer le livre comme lu">
                                        <i class="fas fa-check-circle card-fa"></i> <!-- <i class="fas fa-check-circle"></i> -->
                                    </button>
                                </form>
                                <form action="<?php echo Router::GenerateRoute('CollectionSouhait') ?>" method="post">
                                    <input id="LivreID" name="LivreID" type="hidden"
                                           value="<?php echo $L->getLivreId(); ?>">
                                    <button type="submit" class="btn p-0  m-1" data-toggle="tooltip" data-placement="top"
                                            title="Ajouter à la liste des souhaits">
                                        <i class="fas fa-list-alt card-fa"></i> <!-- <i class="fas fa-list-alt"></i> -->
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php require './view/Partial/footer.php' ?>
