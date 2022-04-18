<?php
require './view/Partial/head.php';
/**
 * @var CLients $Client
 * @var int $lu
 * @var int $souhait
 * @var Visibilite $vs
 * @var Visibilite $vc
 */
?>
    <h3>Bienvenue <?=$Client->getPrenom()?> !</h3>
    <p>Votre adresse mail est <?=$Client->getMail()?>.</p>
    <p>Vous avez lu <?=$lu?> livre(s) et vous souhaitez en lire <?=$souhait?>.</p>
    <p>Votre liste des souhaits est visible par <?=$vs->getNom()?> et la liste des livres lu par <?=$vc->getNom()?>.
    <p>
        <a href="<?php echo Router::GenerateRoute('ClientUpdate') ?>">
            <button type="submit" class="btn btn-primary m-1" data-toggle="tooltip" data-placement="top"
                    title="Modifier">
                Modifier mes informations
            </button>
        </a>
        <a href="<?php echo Router::GenerateRoute('PWDUpdate') ?>">
            <button type="submit" class="btn btn-primary m-1" data-toggle="tooltip" data-placement="top"
                    title="Modifier">
                Modifier le Mot de Passe
            </button>
        </a>
    <a href="<?php echo Router::GenerateRoute('SelfDelete') ?>">
            <button type="submit" class="btn btn-primary m-1" data-toggle="tooltip" data-placement="top" onclick="return(confirm('Etes-vous sûr de vouloir supprimer de votre compte ? Cette action est définitive et irréversible !'))";
                    title="Supprimer">
                Supprimer son compte
            </button>
        </a>
    </p>
<?php require './view/Partial/footer.php' ?>
