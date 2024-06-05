<?php
include 'functions.php';

// Conectar ao banco de dados PostgreSQL
$pdo = pdo_connect_pgsql();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Número de registros para mostrar em cada página
$records_per_page = 8;

$data_fim = '';
$data_inicio = '';

if (isset($_GET['data_inicio']) && isset($_GET['data_fim'])) {
    $data_inicio = $_GET['data_inicio'];
    $data_fim = $_GET['data_fim'];
    $sql = 'SELECT reservas.id_reserva, clientes.nome AS cliente_nome, clientes.sobrenome AS cliente_sobrenome, carros.marca, carros.modelo, carros.placa, reservas.data_reserva, reservas.data_devolucao FROM reservas 
    INNER JOIN clientes ON reservas.id_cliente = clientes.id_cliente 
    INNER JOIN carros ON reservas.id_carro = carros.id_carro
    WHERE data_reserva >= :data_inicio AND data_devolucao <= :data_fim ORDER BY data_reserva OFFSET :offset LIMIT :limit';
} else {
    $sql = 'SELECT reservas.id_reserva, clientes.nome AS cliente_nome, clientes.sobrenome AS cliente_sobrenome, carros.marca, carros.modelo, carros.placa, reservas.data_reserva, reservas.data_devolucao FROM reservas 
    INNER JOIN clientes ON reservas.id_cliente = clientes.id_cliente 
    INNER JOIN carros ON reservas.id_carro = carros.id_carro
    ORDER BY id_reserva OFFSET :offset LIMIT :limit';
}

$stmt = $pdo->prepare($sql);

if (isset($_GET['data_inicio']) && isset($_GET['data_fim'])) {
    $stmt->bindParam(':data_inicio', $data_inicio);
    $stmt->bindParam(':data_fim', $data_fim);
}
$stmt->bindValue(':offset', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':limit', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obter o número total de registros, isso é para determinar se deve haver um botão de próxima e anterior
$num_reservas = $pdo->query('SELECT COUNT(*) FROM reservas')->fetchColumn();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= template_head2("Listar Reservas") ?>
    <link rel="stylesheet" href="../css/styleCadastro.css">
    <link rel="stylesheet" href="../css/styleRead.css">
</head>

<body>
    <?= template_header2() ?>
    <?= voltar("indexAluga.php") ?>
    <div class="content read">
        <form action="" method="get">
            <label for="data_inicio">Data Início:</label>
            <input type="date" name="data_inicio" id="data_inicio" value="<?= isset($_GET['data_inicio']) ? $_GET['data_inicio'] : '' ?>">
            <label for="data_fim">Data Fim:</label>
            <input type="date" name="data_fim" id="data_fim" value="<?= isset($_GET['data_fim']) ? $_GET['data_fim'] : '' ?>">
            <input type="submit" value="Filtrar">
        </form>

        <table>
            <thead>
                <tr>
                    <td>Id Reserva</td>
                    <td>Nome do Cliente</td>
                    <td>Sobrenome do Cliente</td>
                    <td>Marca</td>
                    <td>Modelo</td>
                    <td>Placa</td>
                    <td>Data de Reserva</td>
                    <td>Data de Devolução</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $reserva) : ?>
                    <tr>
                        <td><?= $reserva['id_reserva'] ?></td>
                        <td><?= $reserva['cliente_nome'] ?></td>
                        <td><?= $reserva['cliente_sobrenome'] ?></td>
                        <td><?= $reserva['marca'] ?></td>
                        <td><?= $reserva['modelo'] ?></td>
                        <td><?= $reserva['placa'] ?></td>
                        <td><?= $reserva['data_reserva'] ?></td>
                        <td><?= $reserva['data_devolucao'] ?></td>
                        <td class="actions">
                            <a href="updateReserva.php?id_reserva=<?= $reserva['id_reserva'] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                            <a href="deleteReserva.php?id_reserva=<?= $reserva['id_reserva'] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php if ($page > 1) : ?>
                <a href="searchReserva.php?page=<?= $page - 1 ?>&data_inicio=<?= urlencode(isset($_GET['data_inicio']) ? $_GET['data_inicio'] : '') ?>&data_fim=<?= urlencode(isset($_GET['data_fim']) ? $_GET['data_fim'] : '') ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
            <?php endif; ?>
            <?php if ($page * $records_per_page < $num_reservas) : ?>
                <a href="searchReserva.php?page=<?= $page + 1 ?>&data_inicio=<?= urlencode(isset($_GET['data_inicio']) ? $_GET['data_inicio'] : '') ?>&data_fim=<?= urlencode(isset($_GET['data_fim']) ? $_GET['data_fim'] : '') ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
            <?php endif; ?>
        </div>
    </div>
    <?= template_footer() ?>
</body>

</html>
