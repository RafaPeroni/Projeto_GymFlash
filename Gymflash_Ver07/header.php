<div class="container-fluid">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom align-items-center">
        <a href="index.php"
            class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="logo.png" alt="Logo site">
            <h1 class="mx-2 align-center ff-sp">G<span class="text-danger ls-1 ff-sp">y</span>mFlash</h1>
        </a>
        <ul class="nav nav-pills nav-justified align-items-center">
            <li class="nav-item">
                <a href="academias.php" class="nav-link text-dark link-hover mx-1 text-uppercase">Academias</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark link-hover mx-1 text-uppercase">Contato</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark link-hover mx-1 text-uppercase">Sobre</a>
            </li>
            <li class="nav-item">
                <?php if (!isset($_SESSION['Credencial_academia']) && !isset($_SESSION['Credencial_usuario'])) { ?>
                    <button type="button" class="btn nav-link text-dark link-hover border mx-1 text-uppercase logcad"
                        data-bs-toggle="modal" data-bs-target="#menu">
                        Login/Cadastro
                    </button>
                    <?php
                }
                if (isset($_SESSION['Credencial_academia'])) { ?>
                    <a href="perfil.php?dir=assets/php&file=databaseconnect"
                        class="nav-link text-dark link-hover mx-1 text-uppercase">
                        <?php
                        echo 'Usuário: ' . $_SESSION['Nome_da_academia'];
                } ?>
                    <?php
                    if (isset($_SESSION['Credencial_usuario'])) { ?>
                    </a>
                    <a href="perfil.php?dir=assets/php&file=databaseconnect"
                        class="nav-link text-dark link-hover mx-1 text-uppercase">
                        <?php
                        echo 'Usuário: ' . $_SESSION['Email_usuario'];
                    } ?></a>

            </li>
        </ul>
    </header>
</div>