<?php

include_once("cnxdb.php"); 
include_once("param.php"); 
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


if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

    $data = json_decode(file_get_contents('php://input'), true);

    $id = $_GET['id'];
    $imagemURL = $data['imagemURL'];
    $banner = $data['banner'];


    $sql = " UPDATE blog_imagens SET imagemURl='$imagemURL', banner='$banner' WHERE id = $id ";

    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro atualizando registro: " . $conn->error;
    }
};



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $imagemURL = $_POST['imagemURL'];
    $banner = $_POST['banner'];


    $sql = " INSERT INTO blog_imagens (imagem, banner) VALUES ('$imagemURL', '$banner')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro inserido com sucesso";
    } else {
        echo "Erro ao inserir registro: " . $conn->error;
    }
};


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $linhaID = $_GET['linha'];

    $sql = " SELECT * FROM blog_imagens WHERE id = $linhaID";

    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $emparray[] = $row;
    }

    echo json_encode($emparray);
};

if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){

    $id = $_GET['del'];

    $sql = " DELETE FROM blog_imagens WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro apagado com sucesso";
    } else {
        echo "Erro ao tentar apagar registro: " . $conn->error;
    }
};