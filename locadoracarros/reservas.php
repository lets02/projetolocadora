<?php
include 'functions.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Locadora Cactus - Reservas de Carros</title>
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
      margin-top: 40px;
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
      background-color: #00b33c;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #008000;
    }
  </style>
</head>
<body>
  <?=template_header('Locadora Cactus')?>

  <div class="container">
    <h1>Reservas de Carros</h1>
    <form>
      <div>
        <label for="pickup-date">Data de Retirada:</label>
        <input type="date" id="pickup-date" name="pickup-date" required>
      </div>
      <div>
        <label for="return-date">Data de Devolução:</label>
        <input type="date" id="return-date" name="return-date" required>
      </div>
      <div>
        <label for="car-model">Modelo do Carro:</label>
        <select id="car-model" name="car-model" required>
          <option value="">Selecione um modelo</option>
          <option value="hatch">Hatch</option>
          <option value="sedan">Sedan</option>
          <option value="suv">SUV</option>
          <option value="pickup">Pickup</option>
        </select>
      </div>
      <div>
        <label for="location">Local de Retirada:</label>
        <input type="text" id="location" name="location" required>
      </div>
      <button type="submit">Reservar Carro</button>
    </form>
  </div>

  <?=template_footer()?>
</body>
</html>