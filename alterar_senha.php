<?php
include 'conexao.php';
include 'validacao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $senha_atual_digitada = $_POST['senha_atual'];
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    // Buscar a senha atual do usuário no banco de dados
    $sql_senha_atual = "SELECT password  FROM usuarios WHERE email = '$email'";
    $result_senha_atual = $mysqli->query($sql_senha_atual);

    if ($result_senha_atual && $result_senha_atual->num_rows == 1) {
        $row = $result_senha_atual->fetch_assoc();
        $senha_atual_banco = $row['password'];

        // Verificar se a senha atual digitada corresponde à senha no banco
        if (password_verify($senha_atual_digitada, $senha_atual_banco)) {
            // Verificar se a nova senha e a confirmação coincidem
            if ($nova_senha === $confirmar_senha) {
                // Validar o comprimento da nova senha (adicione outras validações se necessário)
                if (strlen($nova_senha) >= 6) {
                    // Criptografar a nova senha
                    $nova_senha_criptografada = password_hash($nova_senha, PASSWORD_DEFAULT);

                    // Atualizar a senha no banco de dados
                    $stmt = $mysqli->prepare("UPDATE usuarios SET password = ? WHERE email = ?");
                    $stmt->bind_param("ss", $nova_senha_criptografada, $email);

                    if ($stmt->execute()) {
                        echo "<script>alert('Senha alterada com sucesso!'); window.location.href='perfil.php';</script>";
                        exit;
                    } else {
                        $erro = "Erro ao alterar a senha no banco de dados.";
                    }

                    $stmt->close();
                } else {
                    $erro = "A nova senha deve ter pelo menos 6 caracteres.";
                }
            } else {
                $erro = "A nova senha e a confirmação não coincidem.";
            }
        } else {
            $erro = "A senha atual está incorreta.";
        }
    } else {
        $erro = "Erro ao buscar a senha atual do usuário.";
    }

    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Alterar Senha</title>
    <link rel="stylesheet" href="assets/css/perfil.css">
    <link rel="stylesheet" href="assets/css/alterar_senha.css">
    <link rel="shortcut icon" type="imagex/png" href="assets/img/logo.png">
</head>

<body>
    <div class="main-content">
        <div class="profile-area">
            <h1>Alterar Senha</h1>
            <?php if (isset($erro)) echo "<p style='color: red;'>$erro</p>"; ?>
            <form method="POST">
                <div class="input-wrapper">
                    <input type="password" name="senha_atual" placeholder="Senha atual" required class="profile-input" id="senha_atual">
                </div>
                <div class="input-wrapper">
                    <input type="password" name="nova_senha" placeholder="Nova senha" required class="profile-input" id="nova_senha">
                </div>
                <div class="input-wrapper">
                    <input type="password" name="confirmar_senha" placeholder="Confirmar nova senha" required class="profile-input" id="confirmar_senha">
                </div>
                <button type="submit" class="save-button">Salvar Nova Senha</button>
                <button class="back-button" onclick="history.back()">Voltar</button>
            </form>
        </div>
    </div>
</body>

</html>