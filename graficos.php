<?php
include 'conexao.php';
include 'validacao.php';

$sqlCores = "SELECT c.cor, COUNT(p.cor) AS quantidade FROM tb_cor c LEFT JOIN tb_prod p ON c.id_cor = p.cor GROUP BY c.cor";
$resultCores = $mysqli->query($sqlCores);
$cores = [];
$quantidadesCores = [];
if ($resultCores->num_rows > 0) {
    while ($row = $resultCores->fetch_assoc()) {
        $cores[] = $row["cor"];
        $quantidadesCores[] = $row["quantidade"];
    }
}

$sqlMateriais = "SELECT m.material, COUNT(p.material) AS quantidade FROM tb_material m LEFT JOIN tb_prod p ON m.id_material = p.material GROUP BY m.material";
$resultMateriais = $mysqli->query($sqlMateriais);
$materiais = [];
$quantidadesMateriais = [];
if ($resultMateriais->num_rows > 0) {
    while ($row = $resultMateriais->fetch_assoc()) {
        $materiais[] = $row["material"];
        $quantidadesMateriais[] = $row["quantidade"];
    }
}

$sqlTamanhos = "SELECT t.tamanho, COUNT(p.tamanho) AS quantidade FROM tb_tamanho t LEFT JOIN tb_prod p ON t.id_tamanho = p.tamanho GROUP BY t.tamanho";
$resultTamanhos = $mysqli->query($sqlTamanhos);
$tamanhos = [];
$quantidadesTamanhos = [];
if ($resultTamanhos->num_rows > 0) {
    while ($row = $resultTamanhos->fetch_assoc()) {
        $tamanhos[] = $row["tamanho"];
        $quantidadesTamanhos[] = $row["quantidade"];
    }
}

$sqlCombinacao = "SELECT c.cor, m.material, COUNT(*) AS quantidade
                    FROM tb_prod p
                    LEFT JOIN tb_cor c ON p.cor = c.id_cor
                    LEFT JOIN tb_material m ON p.material = m.id_material
                    GROUP BY c.cor, m.material";
$resultCombinacao = $mysqli->query($sqlCombinacao);
$combinacoes = [];
if ($resultCombinacao->num_rows > 0) {
    while ($row = $resultCombinacao->fetch_assoc()) {
        $combinacoes[] = $row;
    }
}

$emailUsuario = $_SESSION['email'];
$sqlAnotacoes = "SELECT anotacoes FROM usuarios WHERE email = '$emailUsuario'";
$resultAnotacoes = $mysqli->query($sqlAnotacoes);
$anotacoes = "";
if ($resultAnotacoes && $resultAnotacoes->num_rows > 0) {
    $rowAnotacoes = $resultAnotacoes->fetch_assoc();
    $anotacoes = $rowAnotacoes['anotacoes'];
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficos - StellarCode</title>
    <link rel="stylesheet" href="assets/css/graficos.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="shortcut icon" type="imagex/png" href="assets/img/logo.png">
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

    <div class="container">
        <div class="grafico-container">
            <canvas id="graficoCores"></canvas>
        </div>

        <div class="grafico-container">
            <canvas id="graficoMateriais"></canvas>
        </div>

        <div class="grafico-container">
            <canvas id="graficoTamanhos"></canvas>
        </div>

        <div class="grafico-container">
            <canvas id="graficoCombinacao"></canvas>
        </div>

        <div class="anotacoes-container">
            <textarea id="anotacoes" class="anotacoes-input" placeholder="Digite suas anotações sobre os gráficos..."><?php echo htmlspecialchars($anotacoes); ?></textarea>
            <button id="salvar-anotacoes" class="salvar-anotacoes-button">Salvar Anotações</button>
        </div>

        <div style="display: none;">
            <span id="cores-data"><?php echo json_encode($cores); ?></span>
            <span id="quantidades-cores-data"><?php echo json_encode($quantidadesCores); ?></span>
            <span id="materiais-data"><?php echo json_encode($materiais); ?></span>
            <span id="quantidades-materiais-data"><?php echo json_encode($quantidadesMateriais); ?></span>
            <span id="tamanhos-data"><?php echo json_encode($tamanhos); ?></span>
            <span id="quantidades-tamanhos-data"><?php echo json_encode($quantidadesTamanhos); ?></span>
            <span id="combinacoes-data"><?php echo json_encode($combinacoes); ?></span>
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
    <script src="assets/js/graficos.js"></script>
    <script>
        document.getElementById('salvar-anotacoes').addEventListener('click', function() {
            const anotacoes = document.getElementById('anotacoes').value;
            fetch('salvar_anotacoes.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'anotacoes=' + encodeURIComponent(anotacoes),
                })
                .then(response => {
                    if (response.ok) {
                        alert('Anotações salvas com sucesso!');
                    } else {
                        alert('Erro ao salvar anotações.');
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert('Erro ao salvar anotações.');
                });
        });
    </script>
</body>

</html>