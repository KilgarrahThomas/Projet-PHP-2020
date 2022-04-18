<?php
require './view/Partial/head.php';
?>
    <div class="row w-100 m-0">
        <div class="col">
            <p>Listing des livres</p>
        </div>
        <div class="col-auto p-0">
            <form action="<?php echo Router::GenerateRoute('LivreEdit') ?>" method="post">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                        title="Modifier">
                    <i class="fas fa-plus-circle"></i>
                    Ajouter un livre
                </button>
            </form>
        </div>
    </div>
    <table id="DataTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Action</th>
            <th>Titre</th>
            <th>Genre</th>
            <th>Auteur</th>
            <th>Maison d'édition</th>

        </tr>
        </thead>
        <?php foreach ($Livre as $L) {;?>
            <tr>
                <td class="p-0">
                    <div class="btn-group" role="group">
                        <button class="bookinfo btn p-0 m-1"
                                data-id="<?php echo $L->getLivreID(); ?>"
                                data-titre="<?php echo $L->getTitre(); ?>"
                                data-toggle="tooltip" data-placement="top" title="Details">
                            <i class="fas fa-search dt-fa"></i>
                        </button>
                        <form action="<?php echo Router::GenerateRoute('LivreEdit') ?>" method="post">
                            <input id="LivreID" name="LivreID" type="hidden"
                                   value="<?php echo $L->getLivreId(); ?>">
                            <button type="submit" class="btn p-0  m-1" data-toggle="tooltip" data-placement="top"
                                    title="Modifier">
                                <i class="fas fa-edit dt-fa"></i>
                            </button>
                        </form>
                        <form action="<?php echo Router::GenerateRoute('LivreDel') ?>" method="post">
                            <input id="LivreID" name="LivreID" type="hidden"
                                   value="<?php echo $L->getLivreId(); ?>">
                            <button type="submit" class="btn p-0  m-1" data-toggle="tooltip" data-placement="top"
                                    onclick="return(confirm('Etes-vous sûr de vouloir supprimer <?=$C->getLivre()->getTitre()?> ?'))";
                                    title="Supprimer">
                                <i class="fas fa-trash-alt dt-fa"></i>
                            </button>
                        </form>
                    </div>
                </td>
                <td><?php echo $L->getTitre(); ?></td>
                <td><?php echo $L->getGenre()->getNom()?></td>
                <td><?php echo $L->getAuteur()->getNom().' '.$L->getAuteur()->getPrenom(); ?></td>
                <td><?php echo $L->getEdition()->getMaisonEdition(); ?></td>
            </tr>
        <?php } ?>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="LivreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalBookName">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <!--                    <button type="button" class="btn btn-primary">Save changes</button>-->
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            console.log('loaded');
            $('.bookinfo').click(function(){
                var LivreID = $(this).data('id');
                $('.modal-body').html("");
                $('#ModalBookName').text($(this).data('titre'));
                console.log('click');
                // AJAX request
                $.ajax({
                    url: '<?php echo Router::GenerateRoute('LivreShow') ?>',
                    type: 'post',
                    data: {LivreID: LivreID},
                    success: function(response){
                        // Add response in Modal body
                        $('.modal-body').html(response);
                        // Display Modal
                        $('#LivreModal').modal('show');
                    }
                });
            });
        });
    </script>
<?php require './view/Partial/footer.php' ?>