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

// Verifique se o método de requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenha os dados do formulário
    $nm_produto = $_POST["nm_produto"];
    $nm_marca = $_POST["nm_marca"];
    $dt_compra = $_POST["dt_compra"];
    $modelo_produto = $_POST["modelo_produto"];
    $condicao_produto = $_POST["condicao_produto"];
    $ds_produto = $_POST["ds_produto"];
    $vl_produto = $_POST["vl_produto"];

    // Query de inserção no banco com Prepared Statements
    $insert = "INSERT INTO tb_produto 
                (nm_produto, nm_marca, dt_compra, modelo_produto, condicao_produto, ds_produto, vl_produto, fk_tb_usuario_cd_cliente) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar a query
    if ($stmt = $conn->prepare($insert)) {
        // Bind dos parâmetros
        $stmt->bind_param("ssssssdi", $nm_produto, $nm_marca, $dt_compra, $modelo_produto, $condicao_produto, $ds_produto, $vl_produto, $cd_cliente);

        // Executar a query
        if ($stmt->execute()) {
            echo "Produto inserido com sucesso!";
            header("Location: ../Produtos/produtos.php");
            exit();
        } else {
            echo "Erro ao inserir: " . $stmt->error;
        }
        $stmt->close(); // Fechar o statement
    } else {
        echo "Erro ao preparar a consulta: " . $conn->error;
    }
}

$conn->close(); // Fechar a conexão
?>
