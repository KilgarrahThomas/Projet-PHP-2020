<menu class="p-0 m-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav justify-content-between w-100">
            <li class="nav-item" >
                <a class="nav-link" <?php if($this->page == 'Index') {echo 'id="CURRENT"';} ?> href="<?php echo Router::GenerateRoute('Index') ?>">Accueil</a>
            </li>
            <?php if(intval($this->Client->getLevel()) >= Clients::LevelUser)
                { ?>
                    <li class="nav-item">
                        <a class="nav-link" <?php if($this->page == 'Bibli') {echo 'id="CURRENT"';} ?> href="<?php echo Router::GenerateRoute('Bibli') ?>">Bibliothèque</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" <?php if($this->page == 'Read') {echo 'id="CURRENT"';} ?> href="<?php echo Router::GenerateRoute('Collection') ?>">Collection</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" <?php if($this->page == 'Wished') {echo 'id="CURRENT"';} ?> href="<?php echo Router::GenerateRoute('Souhaits') ?>">Souhaits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" <?php if($this->page == 'Compte') {echo 'id="CURRENT"';} ?> href="<?php echo Router::GenerateRoute('Compte') ?>">Compte</a>
                    </li>
                        <?php if(intval($this->Client->getLevel()) >= Clients::LevelAdministrateur)
                            { ?>
                                <li class="nav-item">
                                    <a class="nav-link" <?php if($this->page == 'Message') {echo 'id="CURRENT"';} ?> href="<?php echo Router::GenerateRoute('Messages') ?>">Messages</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        Administration
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" <?php if($this->page == 'Clients') {echo 'id="CURRENT"';} ?> href="<?php echo Router::GenerateRoute('Clients') ?>">Clients</a>
                                        <a class="dropdown-item" <?php if($this->page == 'Livre') {echo 'id="CURRENT"';} ?> href="<?php echo Router::GenerateRoute('Livre') ?>">Livres</a>
                                        <a class="dropdown-item" <?php if($this->page == 'Auteur') {echo 'id="CURRENT"';} ?> href="<?php echo Router::GenerateRoute('Auteur') ?>">Auteurs</a>
                                        <a class="dropdown-item" <?php if($this->page == 'Edition') {echo 'id="CURRENT"';} ?> href="<?php echo Router::GenerateRoute('Edition') ?>">Edition</a>
                                        <a class="dropdown-item" <?php if($this->page == 'Genre') {echo 'id="CURRENT"';} ?> href="<?php echo Router::GenerateRoute('Genre') ?>">Genres</a>
                                        <a class="dropdown-item" <?php if($this->page == 'Visi') {echo 'id="CURRENT"';} ?> href="<?php echo Router::GenerateRoute('Visibility') ?>">Visibilité</a>
                                    </div>
                                </li>
                            <?php } else {?>
                    <li class="nav-item">
                        <a class="nav-link" <?php if($this->page == 'Contact') {echo 'id="CURRENT"';} ?> href="<?php echo Router::GenerateRoute('Contact') ?>">Contacts</a>
                    </li>
            <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Router::GenerateRoute('Logout') ?>">Se déconnecter</a>
                    </li>
                <?php }
                else
                    { ?>
                        <li class="nav-item">
                            <a class="nav-link" <?php if($this->page == 'Connex') {echo 'id="CURRENT"';} ?> href="<?php echo Router::GenerateRoute('Connexion') ?>">Se connecter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" <?php if($this->page == 'Inscription') {echo 'id="CURRENT"';} ?> href="<?php echo Router::GenerateRoute('Inscription') ?>">S'incrire</a>
                        </li>
                  <?php  } ?>
        </ul>
    </nav>
</menu>
<main>
        