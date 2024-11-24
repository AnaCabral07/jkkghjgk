<?php
// Definindo as variáveis de conexão com o banco
$servidor = "localhost";
$user = "root";
$password = "root";
$banco = "bd_sustentech";

// Conexão com o banco de dados utilizando PDO
try {
    $pdo = new PDO("mysql:host=$servidor;dbname=$banco", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

// Iniciando a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['cd_cliente'])) {
    die("Você precisa estar logado para acessar esta página.");
}

$cd_cliente = $_SESSION['cd_cliente']; // Obter o ID do cliente logado

// Consulta para obter os produtos do cliente logado
$queryProducts = "SELECT * FROM tb_produto WHERE fk_tb_usuarios_cd_cliente = :cd_cliente";
$stmtProducts = $pdo->prepare($queryProducts);
$stmtProducts->bindParam(':cd_cliente', $cd_cliente, PDO::PARAM_INT);
$stmtProducts->execute();

// Recuperando os produtos
$produtos = $stmtProducts->fetchAll(PDO::FETCH_ASSOC);

// Exibição dos produtos
foreach ($produtos as $produto) {
    echo "<div class='product-card'>";
    echo "<div class='product'><img src='notebook.jpg' alt='Produto'></div>"; // Caminho da imagem deve ser dinâmico ou correto
    echo "<h2 class='product-title'>" . htmlspecialchars($produto['nm_produto']) . "</h2>";
    echo "<p class='product-brand'>Marca: " . htmlspecialchars($produto['nm_marca']) . "</p>";
    echo "<p class='product-condition'>Condição: " . htmlspecialchars($produto['vl_produto']) . "</p>";
    echo "</div>";
}

?>
