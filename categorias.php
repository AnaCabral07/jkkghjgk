<?php
$servidor = "localhost";
$user = "root";
$password = "root";
$banco = "bd_sustentech";

// Criando a conexão
$conn = new mysqli($servidor, $user, $password,  $banco);

session_start();

// Verificar se o cliente está logado
if (!isset($_SESSION['fk_tb_usuario_cd_cliente'])) {
    header("Location: login.php"); // Redirecionar para o login
    exit;
}

$cd_cliente = $_SESSION['fk_tb_usuario_cd_cliente'];

// Validar o ID do cliente
if (!is_numeric($cd_cliente)) {
    die("Erro: ID do cliente inválido.");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre seus Produtos</title>
    <link rel="icon" type="image/png" href="../img/favicon.png">
    <link rel="stylesheet" href="../NavBar/navbar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <style>
        /* Corpo com fundo cinza-claro */
        .body1 {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }

        /* Estilo para o título com leve degradê */
        h1 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 2.5rem;
            background: linear-gradient(to right, #0d7e2e, #1e824c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .container {
            max-width: 900px;
        }

        /* Estilo das caixas de seleção */
        .square {
            background-color: #0d7e2e; /* Fundo verde */
            color: white;
            display: flex;
            flex-direction: row;
            align-items: center;
            text-align: center;
            justify-content: flex-start;
            padding: 5px;
            width: 200px;
            height: 150px;
            margin: 20px auto;
            border-radius: 15px;
            font-size: 1.2rem;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); /* Sombra suave */
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Efeito ao passar o mouse */
            cursor: pointer;
            border: 2px solid #1e824c; /* Borda para destacar */
        }

        /* Efeito ao passar o mouse nas caixas */
        .square:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.25);
        }

        /* Ícone */
        .icon {
            width: 75px;
            height: 75px;
            margin-right: 10px;
        }

        /* Alinhamento e espaçamento dos itens */
        .row {
            display: flex;
            justify-content: space-evenly;
            flex-wrap: wrap;
        }

        /* Ajuste responsivo para telas menores */
        @media (max-width: 768px) {
            .square {
                width: 150px;
                height: 120px;
                padding: 10px;
            }

            .icon {
                width: 50px;
                height: 50px;
                margin-right: 10px;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body class="body1">
    <div id="1-secao">
        <h1>O que deseja cadastrar?</h1>
    </div>
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <div class="square" onclick="window.location.href='form.html';">
                    <img src="https://cdn-icons-png.flaticon.com/128/5521/5521112.png" class="icon" alt="Smartphone">
                    <span>Celulares</span>
                </div>
            </div>
            <div class="col">
                <div class="square" onclick="window.location.href='form.html';">
                    <img src="https://cdn-icons-png.flaticon.com/128/3616/3616729.png" class="icon" alt="Notebook">
                    <span>Notebooks</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="square" onclick="window.location.href='form.html';">
                    <img src="https://cdn-icons-png.flaticon.com/128/10415/10415361.png" class="icon" alt="TV">
                    <span>TVs e Monitores</span>
                </div>
            </div>
            <div class="col">
                <div class="square" onclick="window.location.href='form.html';">
                    <img src="https://cdn-icons-png.flaticon.com/128/2704/2704234.png" class="icon" alt="Desktop">
                    <span>Desktops</span>
                </div>
            </div>
            <div class="col">
                <div class="square" onclick="window.location.href='form.html';">
                    <img src="https://cdn-icons-png.flaticon.com/128/174/174254.png" class="icon" alt="Fones">
                    <span>Fones de Ouvido</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>