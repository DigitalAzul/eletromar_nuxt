<?php

include_once("cnxdb.php"); 
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "mectronic";

// $conn = new mysqli(
//     $servername,
//     $username,
//     $password,
//     $database
// );

// if ($conn->connect_error) {
//     die("Conexão falhou: " . $conn->connect_error);
// };


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    
    $sql = "SELECT c.titulo, categoria_id, COUNT(categoria_id) AS qtd FROM blog_posts AS bp RIGHT JOIN categorias AS c ON bp.categoria_id = c.id GROUP BY categoria_id HAVING COUNT(categoria_id) > 0";

    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $emparray[] = $row;
    }

    echo json_encode($emparray);

    $conn->close();
};