const cores = JSON.parse(document.getElementById('cores-data').textContent);
const quantidadesCores = JSON.parse(document.getElementById('quantidades-cores-data').textContent);
const materiais = JSON.parse(document.getElementById('materiais-data').textContent);
const quantidadesMateriais = JSON.parse(document.getElementById('quantidades-materiais-data').textContent);
const tamanhos = JSON.parse(document.getElementById('tamanhos-data').textContent);
const quantidadesTamanhos = JSON.parse(document.getElementById('quantidades-tamanhos-data').textContent);
const combinacoes = JSON.parse(document.getElementById('combinacoes-data').textContent);

const ctxCores = document.getElementById('graficoCores').getContext('2d');
const graficoCores = new Chart(ctxCores, {
    type: 'pie',
    data: {
        labels: cores,
        datasets: [{
            label: 'Quantidade por Cor',
            data: quantidadesCores,
            backgroundColor: [
                'rgba(255, 206, 86, 0.8)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(75, 192, 192, 0.8)',
                'rgba(255, 99, 132, 0.8)'
            ],
            borderColor: [
                'rgba(255, 206, 86, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: '#f0f0f0'
                }
            },
            title: {
                display: true,
                text: 'Quantidade de Produtos por Cor',
                color: '#f0f0f0'
            }
        }
    }
});

const ctxMateriais = document.getElementById('graficoMateriais').getContext('2d');
const graficoMateriais = new Chart(ctxMateriais, {
    type: 'bar',
    data: {
        labels: materiais,
        datasets: [{
            label: 'Quantidade por Material',
            data: quantidadesMateriais,
            backgroundColor: [
                'rgba(255, 159, 64, 0.8)',
                'rgba(153, 102, 255, 0.8)'
            ],
            borderColor: [
                'rgba(255, 159, 64, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    color: '#f0f0f0'
                },
                grid: {
                    color: 'rgba(255, 255, 255, 0.1)'
                }
            },
            x: {
                ticks: {
                    color: '#f0f0f0'
                },
                grid: {
                    color: 'rgba(255, 255, 255, 0.1)'
                }
            }
        },
        plugins: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: 'Quantidade de Produtos por Material',
                color: '#f0f0f0'
            }
        }
    }
});

const ctxTamanhos = document.getElementById('graficoTamanhos').getContext('2d');
const graficoTamanhos = new Chart(ctxTamanhos, {
    type: 'line',
    data: {
        labels: tamanhos,
        datasets: [{
            label: 'Quantidade por Tamanho',
            data: quantidadesTamanhos,
            fill: false,
            borderColor: 'rgba(255, 205, 86, 1)',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    color: '#f0f0f0'
                },
                grid: {
                    color: 'rgba(255, 255, 255, 0.1)'
                }
            },
            x: {
                ticks: {
                    color: '#f0f0f0'
                },
                grid: {
                    color: 'rgba(255, 255, 255, 0.1)'
                }
            }
        },
        plugins: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: 'Quantidade de Produtos por Tamanho',
                color: '#f0f0f0'
            }
        }
    }
});

const ctxCombinacao = document.getElementById('graficoCombinacao').getContext('2d');
const labelsCombinacao = [...new Set(combinacoes.map(item => item.cor))];
const materiaisCombinacao = [...new Set(combinacoes.map(item => item.material))];
const coresMaterial = {
    'metal': 'rgba(0, 128, 0, 0.8)', 
    'plástico': 'rgba(54, 162, 235, 0.8)'
};

const datasetsCombinacao = materiaisCombinacao.map(material => {
    return {
        label: material,
        data: labelsCombinacao.map(corLabel => {
            const item = combinacoes.find(c => c.cor === corLabel && c.material === material);
            return item ? item.quantidade : 0;
        }),
        backgroundColor: coresMaterial[material.toLowerCase()] || 'rgba(128, 128, 128, 0.8)'
    };
});

const graficoCombinacao = new Chart(ctxCombinacao, {
    type: 'bar',
    data: {
        labels: labelsCombinacao,
        datasets: datasetsCombinacao
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    color: '#f0f0f0'
                },
                grid: {
                    color: 'rgba(255, 255, 255, 0.1)'
                }
            },
            x: {
                ticks: {
                    color: '#f0f0f0'
                },
                grid: {
                    color: 'rgba(255, 255, 255, 0.1)'
                }
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Quantidade de Produtos por Cor e Material',
                color: '#f0f0f0'
            },
            legend: {
                labels: {
                    color: '#f0f0f0'
                }
            }
        }
    }
});

function getRandomColor() {
    const r = Math.floor(Math.random() * 255);
    const g = Math.floor(Math.random() * 255);
    const b = Math.floor(Math.random() * 255);
    return `rgba(${r}, ${g}, ${b}, 0.8)`;
}