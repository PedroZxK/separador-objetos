<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - StellarCode</title>
    <link rel="stylesheet" href="assets/css/cadastro.css">
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