<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Alterar Senha</title>
    <link rel="stylesheet" href="assets/css/perfil.css">
    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            max-width: 400px;
            margin: 0 auto;
        }

        .input-wrapper {
            position: relative;
            width: 100%;
        }

        .profile-input {
            width: 100%;
            padding: 10px 40px 10px 10px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            width: 24px;
            height: 24px;
        }

        .save-button {
            padding: 10px 20px;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
        }

        .profile-area {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="profile-area">
            <h1>Alterar Senha</h1>
            <?php if (isset($erro)) echo "<p style='color: red;'>$erro</p>"; ?>
            <form method="POST">
                <div class="input-wrapper">
                    <input type="password" name="senha_atual" placeholder="Senha atual" required class="profile-input" id="senha_atual">
                    <img src="assets/img/olho_fechado.png" class="eye-icon" onclick="toggleSenha('senha_atual', this)">
                </div>
                <div class="input-wrapper">
                    <input type="password" name="nova_senha" placeholder="Nova senha" required class="profile-input" id="nova_senha">
                    <img src="assets/img/olho_fechado.png" class="eye-icon" onclick="toggleSenha('nova_senha', this)">
                </div>
                <div class="input-wrapper">
                    <input type="password" name="confirmar_senha" placeholder="Confirmar nova senha" required class="profile-input" id="confirmar_senha">
                    <img src="assets/img/olho_fechado.png" class="eye-icon" onclick="toggleSenha('confirmar_senha', this)">
                </div>
                <button type="submit" class="save-button">Salvar Nova Senha</button>
                <button class="back-button" onclick="history.back()">Voltar</button>
            </form>
        </div>
    </div>

    <script>
        function toggleSenha(inputId, iconElement) {
            const input = document.getElementById(inputId);
            const aberto = "assets/img/olho_aberto.png";
            const fechado = "assets/img/olho_fechado.png";

            if (input.type === "password") {
                input.type = "text";
                iconElement.src = aberto;
            } else {
                input.type = "password";
                iconElement.src = fechado;
            }
        }
    </script>
</body>

</html>