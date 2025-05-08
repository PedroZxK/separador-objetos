<?php
// Conexão com o banco de dados (substitua com suas credenciais)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "separador_objetos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta para obter dados para o gráfico de cores
$sqlCores = "SELECT cor, COUNT(*) AS quantidade FROM separador_objetos GROUP BY cor";
$resultCores = $conn->query($sqlCores);

$coresData = [];
if ($resultCores->num_rows > 0) {
    while ($row = $resultCores->fetch_assoc()) {
        $coresData[] = ['cor' => $row['cor'], 'quantidade' => $row['quantidade']];
    }
}

// Consulta para obter dados para o gráfico de tamanhos
$sqlTamanhos = "SELECT tamanho, COUNT(*) AS quantidade FROM separador_objetos GROUP BY tamanho";
$resultTamanhos = $conn->query($sqlTamanhos);

$tamanhosData = [];
if ($resultTamanhos->num_rows > 0) {
    while ($row = $resultTamanhos->fetch_assoc()) {
        $tamanhosData[] = ['tamanho' => $row['tamanho'], 'quantidade' => $row['quantidade']];
    }
}

// Consulta para obter dados para o gráfico de materiais
$sqlMateriais = "SELECT material, COUNT(*) AS quantidade FROM separador_objetos GROUP BY material";
$resultMateriais = $conn->query($sqlMateriais);

$materiaisData = [];
if ($resultMateriais->num_rows > 0) {
    while ($row = $resultMateriais->fetch_assoc()) {
        $materiaisData[] = ['material' => $row['material'], 'quantidade' => $row['quantidade']];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficos</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }
        .chart-wrapper {
            background-color: #1e293b;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: #f0f9ff;
            width: calc(33% - 40px); /* Para 3 gráficos por linha com espaçamento */
            min-width: 300px;
            box-sizing: border-box;
        }
        @media (max-width: 900px) {
            .chart-wrapper {
                width: calc(50% - 20px); /* Para 2 gráficos por linha em telas menores */
            }
        }
        @media (max-width: 600px) {
            .chart-wrapper {
                width: 100%; /* Para 1 gráfico por linha em telas pequenas */
            }
        }
        h2 {
            color: #86efac;
            margin-top: 0;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">S</div>
        <nav>
            <ul>
                <li><a href="graficos.php" class="active">Gráficos</a></li>
                <li><a href="inicio.php">Início</a></li>
                <li><a href="perfil.php">Perfil</a></li>
            </ul>
        </nav>
        <div class="logout">
            <a href="pagina_inicial.php">Página Inicial</a>
            <button><svg viewBox="0 0 24 24"><path fill="currentColor" d="M13 12c0-1.1-.9-2-2-2s-2 .9-2 2 .9 2 2 2 2-.9 2-2m10-2V6c0-1.1-.9-2-2-2H3c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2v-4l-4-4m-2 10H5v-8l4 4 4-4 4 4 4-4v8z"/></svg></button>
        </div>
    </div>
    <div class="content">
        <header>
            <h1>Visualização de Dados</h1>
        </header>
        <main>
            <div class="chart-container">
                <div class="chart-wrapper">
                    <h2>Objetos por Cor</h2>
                    <canvas id="coresChart"></canvas>
                </div>

                <div class="chart-wrapper">
                    <h2>Objetos por Tamanho</h2>
                    <canvas id="tamanhosChart"></canvas>
                </div>

                <div class="chart-wrapper">
                    <h2>Objetos por Material</h2>
                    <canvas id="materiaisChart"></canvas>
                </div>
            </div>
        </main>
        <footer>
            <div class="social-icons">
                <a href="#"><svg viewBox="0 0 24 24"><path fill="currentColor" d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3h-4.4v5.3H9.5v-12h4.4v5.3H18z"/></svg></a>
                <a href="#"><svg viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2m0 5a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5m0 12.2a7.2 7.2 0 0 1-7.2-7.2c0-1.33.38-2.58 1.04-3.64.07.08.16.15.24.22l2.83 2.83c-.14.3-.22.63-.22.98 0 1.1.9 2 2 2s2-.9 2-2c0-.35-.08-.68-.22-.98l2.83-2.83c.08-.07.16-.14.24-.22.66 1.06 1.04 2.31 1.04 3.64a7.2 7.2 0 0 1-7.2 7.2z"/></svg></a>
                <a href="#"><svg viewBox="0 0 24 24"><path fill="currentColor" d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2m-.5 4.25l-7.07 4.42c-.32.2-.74.2-1.06 0L4.5 8.25M19 18H5v-8l6.21 3.88c.28.18.61.18.89 0L19 10v8z"/></svg></button>
            </div>
            <div class="copyright">Todos os direitos reservados</div>
        </footer>
    </div>

    <script>
        // Dados para o gráfico de cores
        var coresData = <?php echo json_encode($coresData); ?>;
        var coresLabels = coresData.map(item => item.cor);
        var coresQuantidades = coresData.map(item => item.quantidade);

        var coresCtx = document.getElementById('coresChart').getContext('2d');
        var coresChart = new Chart(coresCtx, {
            type: 'pie',
            data: {
                labels: coresLabels,
                datasets: [{
                    data: coresQuantidades,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)',
                        'rgba(255, 0, 255, 0.7)',
                        'rgba(255, 255, 255, 0.7)',
                        'rgba(0, 0, 0, 0.7)',
                        'rgba(128, 128, 128, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 0, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(0, 0, 0, 1)',
                        'rgba(128, 128, 128, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: false,
                transitions: {
                    show: {
                        animations: {
                            colors: {
                                from: 'transparent'
                            }
                        }
                    },
                    hide: {
                        animations: {
                            colors: {
                                to: 'transparent'
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#f0f9ff'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (context.parsed !== null) {
                                    label += ': ' + context.parsed;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Dados para o gráfico de tamanhos
        var tamanhosData = <?php echo json_encode($tamanhosData); ?>;
        var tamanhosLabels = tamanhosData.map(item => item.tamanho);
        var tamanhosQuantidades = tamanhosData.map(item => item.quantidade);

        var tamanhosCtx = document.getElementById('tamanhosChart').getContext('2d');
        var tamanhosChart = new Chart(tamanhosCtx, {
            type: 'bar',
            data: {
                labels: tamanhosLabels,
                datasets: [{
                    label: 'Quantidade',
                    data: tamanhosQuantidades,
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: false,
                transitions: {
                    show: {
                        animations: {
                            colors: {
                                from: 'transparent'
                            }
                        }
                    },
                    hide: {
                        animations: {
                            colors: {
                                to: 'transparent'
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#f0f9ff'
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#f0f9ff'
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#f0f9ff'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (context.parsed.y !== null) {
                                    label += ': ' + context.parsed.y;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Dados para o gráfico de materiais
        var materiaisData = <?php echo json_encode($materiaisData); ?>;
        var materiaisLabels = materiaisData.map(item => item.material);
        var materiaisQuantidades = materiaisData.map(item => item.quantidade);

        var materiaisCtx = document.getElementById('materiaisChart').getContext('2d');
        var materiaisChart = new Chart(materiaisCtx, {
            type: 'doughnut',
            data: {
                labels: materiaisLabels,
                datasets: [{
                    data: materiaisQuantidades,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: false,
                transitions: {
                    show: {
                        animations: {
                            colors: {
                                from: 'transparent'
                            }
                        }
                    },
                    hide: {
                        animations: {
                            colors: {
                                to: 'transparent'
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#f0f9ff'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (context.parsed !== null) {
                                    label += ': ' + context.parsed;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>