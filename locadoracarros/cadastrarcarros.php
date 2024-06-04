<?php
include 'functions.php';
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
    <form>
      <div>
        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" required>
      </div>
      <div>
        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" required>
      </div>
      <div>
        <label for="ano">Ano:</label>
        <input type="number" id="ano" name="ano" required>
      </div>
      <div>
        <label for="cor">Cor:</label>
        <input type="text" id="cor" name="cor" required>
      </div>
      <div>
        <label for="placa">Placa:</label>
        <input type="text" id="placa" name="placa" required>
      </div>
      <div>
        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria" required>
          <option value="">Selecione a categoria</option>
          <option value="popular">Popular</option>
          <option value="intermediario">Intermediário</option>
          <option value="luxo">Luxo</option>
        </select>
      </div>
      <div>
        <label for="diaria">Diária:</label>
        <input type="number" id="diaria" name="diaria" step="0.01" required>
      </div>
      <div>
        <button type="submit">Cadastrar Carro</button>
      </div>
    </form>
  </div>

  <?=template_footer()?>
</body>
</html>