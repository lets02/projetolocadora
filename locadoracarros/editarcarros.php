<?php
include 'functions.php';
$pdo = pdo_connect_pgsql();
$msg = '';

// Verifica se o ID do carro existe
if (isset($_GET['id_carro'])) {
    // Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém os valores do formulário
        $disponibilidade = $_POST['disponibilidade'];
        $placa = $_POST['placa'];
        $tipo = $_POST['tipo'];
        $ano = $_POST['ano'];
        $modelo = $_POST['modelo'];
        
        // Atualiza os dados do carro no banco de dados
        $stmt = $pdo->prepare('UPDATE carro SET disponibilidade = ?, placa = ?, tipo = ?, ano = ?, modelo = ? WHERE id_carro = ?');
        $stmt->execute([$disponibilidade, $placa, $tipo, $ano, $modelo, $_GET['id_carro']]);
        $msg = 'Carro Atualizado com Sucesso!';
    } else {
        // Seleciona o registro que será editado
        $stmt = $pdo->prepare('SELECT * FROM carro WHERE id_carro = ?');
        $stmt->execute([$_GET['id_carro']]);
        $carro = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$carro) {
            exit('Carro Não Localizado!');
        }
    }
} else {
    exit('Nenhum ID de carro especificado!');
}
?>

<?=template_header('Editar Carro')?>

<div class="content update">
    <h2>Editar Carro - <?=$carro['modelo']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
    <form action="editcarros.php?id_carro=<?=$carro['id_carro']?>" method="post">
        <label for="disponibilidade">Disponibilidade:</label>
        <input type="text" id="disponibilidade" name="disponibilidade" value="<?=$carro['disponibilidade']?>" required>
        <label for="placa">Placa:</label>
        <input type="text" id="placa" name="placa" value="<?=$carro['placa']?>" required>
        <label for="tipo">Tipo:</label>
        <input type="text" id="tipo" name="tipo" value="<?=$carro['tipo']?>" required>
        <label for="ano">Ano:</label>
        <input type="text" id="ano" name="ano" value="<?=$carro['ano']?>" required>
        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" value="<?=$carro['modelo']?>" required>
        <input type="submit" value="Salvar Alterações">
    </form>
    <?php endif; ?>
</div>

<?=template_footer()?>
