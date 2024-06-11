<?php
include 'functions.php';
$pdo = pdo_connect_pgsql();
$msg = '';
// Verifica se os dados POST não estão vazios
if (!empty($_POST)) {
    // Se os dados POST não estiverem vazios, insere um novo registro
    // Configura as variáveis que serão inserid_contatoas. Devemos verificar se as variáveis POST existem e, se não existirem, podemos atribuir um valor padrão a elas.
    // Verifica se a variável POST "nome" existe, se não existir, atribui o valor padrão para vazio, basicamente o mesmo para todas as variáveis
    $disponibilidade= isset($_POST['disponibilidade']) ? $_POST['disponibilidade'] : '';
    $placa = isset($_POST['placa']) ? $_POST['placa'] : '';
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
    $ano = isset($_POST['ano']) ? $_POST['ano'] : '';
    $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
    $id_carro = isset($_POST['id_carro']) ? $_POST['id_carro'] : '';
   
    try{
      // Insere um novo registro na tabela contacts
    $stmt = $pdo->prepare('INSERT INTO carro (disponibilidade, placa, tipo, ano, modelo) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$disponibilidade, $placa, $tipo, $ano, $modelo]);
    // Mensagem de saída
    $msg = 'Cadastro Carro Realizado com Sucesso!';
    } catch (Exception $e){
      $msg = $e;
    }
    
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Locadora Cactus - Cadastro de Carros</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    /* Estilos CSS */
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 40px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-top: 40px; /* Adicionado espaço entre o cabeçalho e o card */
    }

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
    }

    form {
      display: grid;
      grid-template-columns: 1fr 1fr;
      grid-gap: 20px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    input, select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
    }

    button {
      display: block;
      width: 100%;
      padding: 12px;
      background-color: #ff8c00; /* Alterado para laranja */
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #d28401; /* Alterado para um tom mais escuro de laranja */
    }
  </style>
</head>
<body>
  <?=template_header('Locadora Cactus')?>

  <div class="container">
    <h1>Cadastro de Carros</h1>
    <form action="cadastrarcarros.php" method="POST">
      <div>
        <label for="disponibilidade">Disponibilidade:</label>
        <input type="disponibiidade" id="disponibilidade" name="disponibilidade" required>
      </div>
      <div>
        <label for="placa">Placa:</label>
        <input type="placa" id="placa" name="placa" required>
      </div>
      <div>
        <label for="tipo">Tipo:</label>
        <input type="tipo" id="tipo" name="tipo" required>
      </div>
      <div>
        <label for="ano">Ano:</label>
        <input type="text" id="ano" name="ano" required>
      </div>
      <div>
        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" required>
      </div>

      <div>
        <button type="submit">Cadastrar Carro</button>
      </div>
    </form>
  </div>

  <div>
    
  <div style="text-align: center;">
    <br><br><br>   <br><br><br>
    <form method="post" action="listarcarro1.php">
        <button type="submit">Listar Carros</button>
    </form>
</div>

  <p><?=$msg?></p>
  </div>

  <?=template_footer()?>
</body>
</html>