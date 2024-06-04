<?php
include 'functions.php';
$pdo = pdo_connect_pgsql();
$msg = '';
// Verifica se os dados POST não estão vazios
if (!empty($_POST)) {
    // Se os dados POST não estiverem vazios, insere um novo registro
    // Configura as variáveis que serão inserid_contatoas. Devemos verificar se as variáveis POST existem e, se não existirem, podemos atribuir um valor padrão a elas.
    // Verifica se a variável POST "nome" existe, se não existir, atribui o valor padrão para vazio, basicamente o mesmo para todas as variáveis
    $cargo= isset($_POST['cargo']) ? $_POST['cargo'] : '';
    $sobrenome = isset($_POST['sobrenome']) ? $_POST['sobrenome'] : '';
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $data_contratacao = isset($_POST['data_contratacao']) ? $_POST['data_contratacao'] : '';
    $salario = isset($_POST['salario']) ? $_POST['salario'] : '';
    $id_funcionnario = isset($_POST['id_funcionnario']) ? $_POST['id_funcionnario'] : '';
    $num_agencia = isset($_POST['num_agencia']) ? $_POST['num_agencia'] : '';
   
    try{
      // Insere um novo registro na tabela contacts
    $stmt = $pdo->prepare('INSERT INTO funcionarios (cargo, sobrenome, nome, data_contratacao, salario,  num_agencia) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$cargo, $sobrenome, $nome, $data_contratacao, $salario, $num_agencia]);
    // Mensagem de saída
    $msg = 'Cadastro Funcionário Realizado com Sucesso!';
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
    <h1>Cadastro do Funcionário</h1>

    <form action="cadastrofunc.php" method="post">
      <div class="form-group">
        <label for="cargo">Cargo</label>
        <input type="cargo" id="cargo" name="cargo" required>
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
        <label for="data_contratacao">Data Contratação:</label>
        <input type="data_contratacao" id="data_contratacao" name="data_contratacao" required>
      </div>

      <div class="form-group">
        <label for="salario">Salário:</label>
        <input type="salario" id="salario" name="salario" required>
      </div>

      <div class="form-group">
        <label for="nome">Número da Agência</label>
        <input type="nome" id="nome" name="nome" required>
      </div>

      <button type="submit">Cadastrar</button>
    </form>
  </div>
  <p><?=$msg?></p>

  <?=template_footer()?>
</body>
</html>