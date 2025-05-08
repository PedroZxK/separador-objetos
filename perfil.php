<?php
include 'conexao.php';
include 'validacao.php';

$nome = $_SESSION['name'];
$email = $_SESSION['email'];

$sql_foto = "SELECT foto FROM usuarios WHERE email = '$email'";
$result_foto = $mysqli->query($sql_foto);
$foto_perfil = 'assets/img/avatar_padrao.png';

if ($result_foto && $result_foto->num_rows > 0) {
    $row_foto = $result_foto->fetch_assoc();
    if ($row_foto['foto']) {
        $foto_perfil_base64 = base64_encode($row_foto['foto']);
        $foto_perfil = 'data:image/jpeg;base64,' . $foto_perfil_base64;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - StellarCode</title>
    <link rel="stylesheet" href="assets/css/perfil.css">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.png">
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
                <form method="POST" action="atualizar_perfil.php" enctype="multipart/form-data" class="profile-right">
                    <div class="profile-left">
                        <div class="profile-img-container">
                            <img src="<?php echo $foto_perfil; ?>" alt="Foto de perfil" class="profile-img" id="preview-img">
                            <div class="edit-icon">
                                <label for="foto-input" class="edit-photo-icon">
                                    <img src="assets/img/lapis.png" alt="Editar Foto">
                                </label>
                            </div>
                            <input type="file" id="foto-input" accept="image/*" name="foto" style="display:none;">
                        </div>

                    </div>
                    <div class="divider"></div>
                    <div class="profile-fields">
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

                        <button type="submit" class="save-button">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-middle">
            <div class="logo-footer">
                <a href="https://linkedin.com"><img src="assets/img/linkedin.png" alt="Linkedin"></a>
                <a href="https://instagram.com"><img src="assets/img/instagram.png" alt="Instagram"></a>
                <a href="https://gmail.com"><img src="assets/img/email.png" alt="Email"></a>
            </div>
            <p>Todos os direitos reservados</p>
        </div>
    </footer>

    <script>
        function editarCampo(campoId) {
            const input = document.getElementById(campoId);
            input.removeAttribute('readonly');
            input.focus();
            input.style.border = '2px solid #00ff88';
        }

        const fotoInput = document.getElementById('foto-input');
        const previewImg = document.getElementById('preview-img');

        fotoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImg.src = event.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>