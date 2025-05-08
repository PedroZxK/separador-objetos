<?php

include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name'])) {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];
        $name = $_POST['name'];

        if (strlen($password) < 8) {
            echo 'A senha deve conter no mínimo 8 caracteres.';
            exit();
        }

        if (empty($email) || empty($password) || empty($name)) {
            echo 'Por favor, preencha todos os campos do formulário.';
            exit();
        }

        $sql = "INSERT INTO usuarios (email, password, name) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param('sss', $email, $hashed_password, $name);

            if ($stmt->execute()) {
                echo '<script>alert("Usuário realizado com sucesso!");window.location.href=("login.php");</script>';
            } else {
                echo 'Erro ao realizar cadastro.';
            }
            $stmt->close();
        } else {
            echo 'Erro ao preparar a declaração: ' . $mysqli->error;
        }
    } else {
        echo 'Por favor, preencha todos os campos do formulário.';
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - StellarCode</title>
    <link rel="stylesheet" href="assets/css/cadastro.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <nav>
        <div class="nav-left">
            <img src="assets/img/logo.png" alt="Logo StellarCode">
        </div>
        <div class="nav-right">
            <a href="index.html" class="button-nav">Página Inicial</a>
        </div>
    </nav>

    <form action="" method="POST">
        <h1>Faça o seu Cadastro</h1>

        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="Insira o seu Email" required>

        <label for="name">Nome:</label>
        <input type="text" name="name" placeholder="Insira o seu Nome de Usuário" required>

        <label for="password">Senha:</label>
        <input type="password" name="password" placeholder="Insira a sua Senha" required>

        <button type="submit">Criar Conta</button>

        <div class="options-login">
            <div class="text-options">
                <hr>
                <p>Outras opções</p>
                <hr>
            </div>
            <a href="login.php">Já tem uma conta?<span class="sign-account"> Fazer Login</span></a>
        </div>
    </form>
</body>

</html>