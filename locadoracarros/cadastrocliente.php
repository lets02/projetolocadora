<?php
include 'functions.php';
$pdo = pdo_connect_pgsql();
$msg = '';
// Verifica se os dados POST não estão vazios
if (!empty($_POST)) {
    // Se os dados POST não estiverem vazios, insere um novo registro
    // Configura as variáveis que serão inserid_contatoas. Devemos verificar se as variáveis POST existem e, se não existirem, podemos atribuir um valor padrão a elas.
    // Verifica se a variável POST "nome" existe, se não existir, atribui o valor padrão para vazio, basicamente o mesmo para todas as variáveis
    $celular = isset($_POST['celular']) ? $_POST['celular'] : '';
    $estado = isset($_POST['estado']) ? $_POST['estado'] : '';
    $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : '';
    $sobrenome = isset($_POST['sobrenome']) ? $_POST['sobrenome'] : '';
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $cidade = isset($_POST['cidade']) ? $_POST['cidade'] : '';
    $id_pagamento = isset($_POST['id_pagamento']) ? $_POST['id_pagamento'] : '';
   
    try{
      // Insere um novo registro na tabela contacts
    $stmt = $pdo->prepare('INSERT INTO cliente (celular, estado, endereco, sobrenome, nome, email, cidade, id_pagamento) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$celular, $estado, $endereco, $sobrenome, $nome, $email,$cidade, $id_pagamento]);
    // Mensagem de saída
    $msg = 'Cadastro Realizado com Sucesso!';
    } catch (Exception $e){
      $msg = $e;
    }
    
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Locadora Cactus - Cadastro</title>
  <style>
    /* Estilos gerais */
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 50px auto;
      background-color: #fff;
      padding: 40px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
    }

    /* Estilos do formulário */
    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: bold;
      color: #555;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
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
  background-color: #808080; /* Cor cinza */
  color: #fff;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #5c5c5c; /* Cor cinza mais escura */
}
  </style>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
  <?=template_header('Locadora Cactus')?>

  <div class="container">
    <h1>Cadastro do Cliente</h1>

    <form action="cadastrocliente.php" method="post">
      <div class="form-group">
        <label for="celular">Celular:</label>
        <input type="celular" id="celular" name="celular" required>
      </div>

      <div class="form-group">
        <label for="estado">Estado:</label>
        <input type="estado" id="estado" name="estado" required>
      </div>

      <div class="form-group">
        <label for="endereco">Endereço:</label>
        <input type="endereco" id="endereco" name="endereco" required>
      </div>

      <div class="form-group">
        <label for="sobrenome">Sobrenome:</label>
        <input type="sobrenome" id="sobrenome" name="sobrenome" required>
      </div>

      <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="nome" id="nome" name="nome" required>
      </div>

      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>

      <div class="form-group">
        <label for="cidade">Cidade:</label>
        <input type="cidade" id="cidade" name="cidade" required>
      </div>
      <div class="form-group">
        <label for="cidade">id_pagamento:</label>
        <input type="text" id="id_pagamento" name="id_pagamento" required>
      </div>


      <button type="submit">Cadastrar</button>
    </form>
    <p><?=$msg?></p>
  </div>

  <?=template_footer()?>
</body>
</html>