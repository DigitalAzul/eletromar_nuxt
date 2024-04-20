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


    $sql = "SELECT bg.*,
    ba.id AS autor_id,
    bgi.id AS bImagem_id,
    ba.nome, ba.bio, ba.bio_en, ba.bio_es, ba.imagem, ba.social_instagram, ba.social_facebook,ba.social_linkedin,
    bgi.imagem_url, bgi.blog_id, bgi.banner
    
    FROM blog_posts AS bg
    LEFT JOIN blog_imagens AS bgi ON bgi.blog_id = bg.id
    LEFT JOIN blog_autor AS ba ON ba.id = bg.blog_autor_id LIMIT 2";


    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $emparray[] = $row;
    }

    echo json_encode($emparray);

    $conn->close();
}


// if ($_SERVER['REQUEST_METHOD'] == 'GET') {

//     echo ("get");

//     $categoria = $_GET['categoria'];

//     echo ($_GET['categoria']);


//     $OFFSET = $_GET['offset'];
//     $QTDROWS = $_GET['qtdrows'];

//     if ($OFFSET > 0 && $QTDROWS > 0) {
//         $xLimit = "LIMIT $OFFSET, OFFSET $QTDROWS";
//     } else {
//         $xLimit = '';
//     }

//     $sql = " SELECT * FROM blog_posts WHERE categoria = $categoria $xLimit";
//     echo ($sql);

//     $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

//     $emparray = array();
//     while ($row = mysqli_fetch_assoc($result)) {
//         $emparray[] = $row;
//     }

//     echo json_encode($emparray);

//     $conn->close();
// };

