<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "postgres";
$password = "postgres";
$dbname = "locadora1";

// Conexão usando a extensão PDO para PostgreSQL
try {
    $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
    // Definindo o modo de erro do PDO como exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para selecionar todos os carros cadastrados
    $sql = "SELECT * FROM Carro";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Exibe os resultados em uma lista
    if ($stmt->rowCount() > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Disponibilidade</th><th>Placa</th><th>Tipo</th><th>Ano</th><th>Modelo</th></tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row["id_carro"] . "</td>";
            echo "<td>" . $row["disponibilidade"] . "</td>";
            echo "<td>" . $row["placa"] . "</td>";
            echo "<td>" . $row["tipo"] . "</td>";
            echo "<td>" . $row["ano"] . "</td>";
            echo "<td>" . $row["modelo"] . "</td>";
            echo "<td class='actions'>
                        <a href='editarcarros.php?id_carro=". $row['id_carro'] ."' class='btn btn-primary btn-sm'><i class='fas fa-edit'></i> Editar</a>
                        <a href='excluircarros.php?id_carro=". $row['id_carro'] ."' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i> Excluir</a>
                    </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum carro cadastrado.";
    }
} catch(PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
}
$conn = null; // Fechando a conexão
?>
