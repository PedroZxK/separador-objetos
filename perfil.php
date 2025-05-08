<?php

include 'conexao.php';
include 'validacao.php';

$nome = $_SESSION['name'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - StellarCode</title>
    <link rel="stylesheet" href="assets/css/perfil.css">
</head>

<body>
    <nav>
        <div class="nav-left">
            <img src="assets/img/logo.png" alt="Logo StellarCode">
        </div>
        <div class="nav-middle">
            <a href="graficos.php">Gráficos</a>
            <a href="home.php">Página Inicial</a>
            <a href="perfil.php">Perfil</a>
        </div>
        <div class="nav-right">
            <a href="logout.php" class="logout-link">
                <img src="assets/img/logout.png" alt="Sair" class="logout-img">
            </a>
        </div>
    </nav>

    <div class="main-content">
        <div class="profile-area">
            <h1>Meu Perfil</h1>
            <div class="profile-container">
                <div class="profile-left">
                    <img src="assets/img/avatar_padrao.png" alt="Foto de perfil" class="profile-img">
                </div>
                <div class="divider"></div>
                <form method="POST" action="atualizar_perfil.php" class="profile-right">
                    <label for="email">Endereço de Email:
                        <img src="assets/img/lapis.png" alt="Editar" class="edit-icon" onclick="editarCampo('email')">
                    </label>
                    <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly class="profile-input">

                    <label for="nome">Nome:
                        <img src="assets/img/lapis.png" alt="Editar" class="edit-icon" onclick="editarCampo('nome')">
                    </label>
                    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" readonly class="profile-input">

                    <div class="senha-section">
                        <label>Senha:</label>
                        <button type="button" class="alterar-senha-btn" onclick="window.location.href='alterar_senha.php'">Alterar Senha</button>
                    </div>

                    <button type="submit" class="save-button" style="display: none;">Salvar Alterações</button>
                </form>

            </div>
        </div>

    </div>

    <footer>
        <div class="footer-middle">
            <div class="logo-footer">
                <img src="assets/img/linkedin.png" alt="Linkedin">
                <img src="assets/img/instagram.png" alt="Instagram">
                <img src="assets/img/email.png" alt="Email">
            </div>
            <p>Todos os direitos reservados</p>
        </div>
    </footer>
    <script>
        function editarCampo(campoId) {
            const input = document.getElementById(campoId);
            const saveButton = document.querySelector('.save-button');

            input.removeAttribute('readonly');
            input.focus();
            input.style.border = '2px solid #00ff88';
            saveButton.style.display = 'block';
        }
    </script>

</body>

</html>