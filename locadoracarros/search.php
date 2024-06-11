<?php
include 'functions.php';

// Inicialize a variável de resultado
$resultado = [];

// Verificar se o formulário de pesquisa foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpar e validar o termo de pesquisa
    $search = trim($_POST["search"]);
    if (empty($search)) {
        $error = 'Por favor, insira o modelo do carro para pesquisar.';
    } else {
        // Consultar o banco de dados para recuperar os carros correspondentes à pesquisa
        $pdo = pdo_connect_pgsql();
        $stmt = $pdo->prepare("SELECT * FROM Carro WHERE Modelo LIKE ?");
        $stmt->execute(["%$search%"]);
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

<?=template_header('Pesquisar Carros')?>

<div class="content read">
    <h2>Pesquisar Carros</h2>
    <form action="" method="post" class="search-form">
        <div class="form-group">
            <label for="search">Modelo do Carro:</label>
            <input type="text" id="search" name="search" placeholder="Digite o modelo do carro...">
        </div>
        <button type="submit" class="btn btn-primary">Pesquisar</button>
    </form>
    <?php if (!empty($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
</div>

<div class="content read">
    <h3>Resultados da Pesquisa</h3>
    <?php if (!empty($resultado)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Modelo</th>
                    <th>Disponibilidade</th>
                    <th>Placa</th>
                    <th>Tipo</th>
                    <th>Ano</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultado as $car): ?>
                    <tr>
                        <td><?=$car['id_carro']?></td>
                        <td><?=$car['modelo']?></td>
                        <td><?=$car['disponibilidade']?></td>
                        <td><?=$car['placa']?></td>
                        <td><?=$car['tipo']?></td>
                        <td><?=$car['ano']?></td>
                        <td class="actions">
                            <a href="editarcarros.php?id_carro=<?=$car['Id_Carro']?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Editar</a>
                            <a href="excluircarros.php?id_carro=<?=$car['Id_Carro']?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?=template_footer()?>
