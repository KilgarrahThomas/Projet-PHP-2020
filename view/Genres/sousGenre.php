 <?php foreach ($G->getEnfants() as $SG) { ?>
        <tr>
            <td class="p-0">
                <div class="btn-group" role="group">
                    <form action="<?php echo Router::GenerateRoute('GenreEdit') ?>" method="post">
                        <input id="GenreID" name="GenreID" type="hidden"
                               value="<?php echo $SG->getGenreID(); ?>">
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
            <td><?php echo $SG->getNom(); ?></td>
            <td><?php echo $SG->getParent()->getNom(); ?></td>
        </tr>
    <?php } ?>