<?php
include 'functions.php';

// Verificar se o formulário de pesquisa foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpar e validar o termo de pesquisa
    $search = trim($_POST["search"]);
    if (empty($search)) {
        $error = 'Por favor, insira o modelo do carro para pesquisar.';
    } else {
        // Redirecionar para a página de resultados de pesquisa com o termo de pesquisa como parâmetro GET
        header("Location: search_results.php?search=$search");
        exit();
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
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Ano</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($car = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?=$car['id_carro']?></td>
                    <td><?=$car['modelo']?></td>
                    <td><?=$car['marca']?></td>
                    <td><?=$car['ano']?></td>
                    <td>R$ <?=number_format($car['preco'], 2, ',', '.')?></td>
                    <td class="actions">
                        <a href="update.php?id=<?=$car['id_carro']?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Editar</a>
                        <a href="delete.php?id=<?=$car['id_carro']?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?=template_footer()?>