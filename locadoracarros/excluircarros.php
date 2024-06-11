<?php
include 'functions.php';
$pdo = pdo_connect_pgsql();
$msg = '';

// Verifica se o ID do carro existe
if (isset($_GET['id_carro'])) {
    // Seleciona o registro que será deletado
    $stmt = $pdo->prepare('SELECT * FROM carro WHERE id_carro = ?');
    $stmt->execute([$_GET['id_carro']]);
    $carro = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$carro) {
        exit('Carro Não Localizado!');
    }
    // Certifique-se de que o usuário confirma antes da exclusão
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM faz WHERE id_carro = ?');
            $stmt->execute([$_GET['id_carro']]);
            $stmt = $pdo->prepare('DELETE FROM locacao WHERE id_carro = ?');
            $stmt->execute([$_GET['id_carro']]);
            // O usuário confirmou a exclusão, então deleta o registro
            $stmt = $pdo->prepare('DELETE FROM carro WHERE id_carro = ?');
            $stmt->execute([$_GET['id_carro']]);
            $msg = 'Carro Apagado com Sucesso!';
        } else {
            // O usuário cancelou a exclusão, redireciona de volta para alguma página
            header('Location: listarcarros1.php');
            exit;
        }
    }
} else {
    exit('Nenhum ID de carro especificado!');
}
?>

<?=template_header('Apagar Carro')?>

<div class="content delete">
    <h2>Apagar Carro - <?=$carro['modelo']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
    <p>Você tem certeza que deseja apagar o carro #<?=$carro['id_carro']?>?</p>
    <div class="yesno">
        <a href="excluircarros.php?id_carro=<?=$carro['id_carro']?>&confirm=yes">Sim</a>
        <a href="excluircarros.php?id_carro=<?=$carro['id_carro']?>&confirm=no">Não</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>
