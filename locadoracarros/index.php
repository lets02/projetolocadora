<?php
include 'functions.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Locadora Cactus</title>
  <style>
    .card-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 40px; /* Aumentei o espaçamento entre os cards */
      padding: 60px 0; /* Aumentei o padding vertical */
    }

    .card {
      width: 1000px; /* Aumentei a largura do card */
      height: 400px;
      border: 1px solid #ccc;
      border-radius: 5px;
      overflow: hidden;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card img {
      width: 50%;
      height: 100%;
      object-fit: cover;
    }

    .card-content {
      width: 50%;
      padding: 30px; /* Aumentei o padding do conteúdo */
      text-align: center;
    }

    .card h3 {
      margin-top: 0;
      font-size: 28px; /* Aumentei o tamanho do título */
    }

    .card p {
      margin-bottom: 30px; /* Aumentei o espaçamento inferior do texto */
      font-size: 18px; /* Aumentei o tamanho do texto */
    }

    .btn {
      display: inline-block;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      padding: 12px 24px; /* Aumentei o padding do botão */
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #0056b3;
    }

    .section-title {
      font-family: 'Montserrat', sans-serif;
      font-size: 36px;
      font-weight: bold;
      text-transform: uppercase;
      text-align: center;
      margin-bottom: 10px;
      color: black;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }
  </style>
</head>
<body>
  <?=template_header('Locadora Cactus')?>

  <h2 class="section-title">Carros mais alugados</h2>

  <div class="card-container">
    <div class="card">
      <img src="img/titano.webp" alt="Carro">
      <div class="card-content">
        <h3>Carro Esportivo</h3>
        <p>Alugue este carro esportivo e aproveite a adrenalina nas ruas.</p>
        <button class="btn">Alugar</button>
      </div>
    </div>
    <div class="card">
      <img src="img/civic.webp" alt="Carro">
      <div class="card-content">
        <h3>Carro Compacto</h3>
        <p>Ideal para você que precisa de um carro prático e econômico.</p>
        <button class="btn">Alugar</button>
      </div>
    </div>
    <div class="card">
      <img src="img/hilux.webp" alt="Carro">
      <div class="card-content">
        <h3>Caminhonete</h3>
        <p>Leve sua família e seus pertences com a nossa caminhonete.</p>
        <button class="btn">Alugar</button>
      </div>
    </div>
    <div class="card">
      <img src="img/onix.webp" alt="Carro">
      <div class="card-content">
        <h3>Carro Médio</h3>
        <p>Conforto e espaço para você e seus amigos.</p>
        <button class="btn">Alugar</button>
      </div>
    </div>
  </div>

  <?=template_footer()?>
</body>
</html>