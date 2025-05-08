    <?php
    include 'conexao.php';
    include 'validacao.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $novoEmail = $_POST['email'];
        $novoNome = $_POST['nome'];
        $emailAtual = $_SESSION['email'];

        $stmt = $mysqli->prepare("UPDATE usuarios SET name = ?, email = ? WHERE email = ?");
        $stmt->bind_param("sss", $novoNome, $novoEmail, $emailAtual);
        $stmt->execute();
        $stmt->close();

        $_SESSION['email'] = $novoEmail;
        $_SESSION['name'] = $novoNome;

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
            $fotoTmp = $_FILES['foto']['tmp_name'];
            $fotoTamanho = $_FILES['foto']['size'];
            $fotoTipo = $_FILES['foto']['type'];

            if ($fotoTamanho > 2097152) {
                echo "<script>alert('Erro: Imagem maior que 2MB.'); window.location.href='perfil.php';</script>";
                exit;
            }

            $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($fotoTipo, $tiposPermitidos)) {
                echo "<script>alert('Erro: Tipo de imagem inválido.'); window.location.href='perfil.php';</script>";
                exit;
            }

            $conteudoImagem = file_get_contents($fotoTmp);

            $stmtFoto = $mysqli->prepare("UPDATE usuarios SET foto = ? WHERE email = ?");
            $null = NULL;
            $stmtFoto->bind_param("bs", $null, $novoEmail);
            $stmtFoto->send_long_data(0, $conteudoImagem);

            if ($stmtFoto->execute()) {
                echo "<script>alert('Perfil atualizado com sucesso!'); window.location.href='perfil.php';</script>";
            } else {
                echo "<script>alert('Erro ao salvar imagem de perfil.'); window.location.href='perfil.php';</script>";
            }

            $stmtFoto->close();
        } else {
            echo "<script>alert('Perfil atualizado com sucesso!'); window.location.href='perfil.php';</script>";
        }
    } else {
        header("Location: perfil.php");
        exit;
    }
