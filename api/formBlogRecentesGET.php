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

    $conn->query("SET lc_time_names = 'pt_BR'");
    $sql = "SELECT bg.id, bg.titulo , bg.titulo_en , bg.titulo_es , DATE_FORMAT(bg.criado_em, '%e de %M de %Y') AS criado_em_br, DATE_FORMAT(criado_em,'%d de %M de %Y') AS data_br
    FROM blog_posts AS bg
    ORDER BY bg.criado_em DESC
    LIMIT 10";

    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $emparray[] = $row;
    }

    echo json_encode($emparray);

    $conn->close();
}