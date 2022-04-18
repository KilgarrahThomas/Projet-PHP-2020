<?php
require './view/Partial/head.php';
?>
    <div class="row w-100 m-0">
        <div class="col">
            <p>Listing des genres</p>
        </div>
        <div class="col-auto p-0">
            <form action="<?php echo Router::GenerateRoute('GenreEdit') ?>" method="post">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                        title="Modifier">
                    <i class="fas fa-plus-circle"></i>
                    Ajouter un nouveau genre
                </button>
            </form>
        </div>
    </div>
    <table id="DataTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Action</th>
            <th>Genre</th>
            <th>Catégorie</th>
        </tr>
        </thead>
        <?php foreach ($Genre as $G) { ?>
            <tr>
                <td class="p-0">
                    <div class="btn-group" role="group">
                        <form action="<?php echo Router::GenerateRoute('GenreEdit') ?>" method="post">
                            <input id="genreID" name="genreID" type="hidden"
                                   value="<?php echo $G->getGenreId(); ?>">
                            <button type="submit" class="btn p-0  m-1" data-toggle="tooltip" data-placement="top"
                                    title="Modifier">
                                <i class="fas fa-edit dt-fa"></i>
                            </button>
                        </form>
                        <form action="<?php echo Router::GenerateRoute('GenreDel') ?>" method="post">
                            <input id="genreID" name="genreID" type="hidden"
                                   value="<?php echo $G->getGenreId(); ?>">
                            <button type="submit" class="btn p-0  m-1" data-toggle="tooltip" data-placement="top"
                                    onclick="return(confirm('Etes-vous sûr de vouloir supprimer <?=$G->getNom(); ?> ?'))";
                                    title="Supprimer">
                                <i class="fas fa-trash-alt dt-fa"></i>
                            </button>
                        </form>
                    </div>
                </td>
                <td><?php echo $G->getNom(); ?></td>
                <td><?php echo $G->getNom(); ?></td>
            </tr>
        <?php if(count($G->getEnfants())>0){
            require './view/Genres/sousGenre.php';
            }
        } ?>
    </table>
<?php require './view/Partial/footer.php' ?>