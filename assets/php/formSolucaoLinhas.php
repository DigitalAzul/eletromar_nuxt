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
    $titulo = $data['titulo'];

    $sql = " UPDATE solucao_linhas SET titulo='$titulo' WHERE id = $id ";

    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro atualizando registro: " . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $json = json_decode($_POST['json']);


    $titulo = $json->titulo;
    $link = $json->link;

    if ($json->emEdicao == false) {
        $sql = " INSERT INTO solucao_linhas (titulo, link) VALUES ('$titulo', '$link')";

        if ($conn->query($sql) === TRUE) {
            echo "Registro inserido com sucesso";
            exit;
        } else {
            echo "Erro ao inserir registro: " . $conn->error;
        }
    }else{
        $id = $json->id;
        $sql = " UPDATE solucao_linhas SET titulo='$titulo', link='$link' WHERE id = $id ";

        if ($conn->query($sql) === TRUE) {
            echo "Registro atualizado com sucesso";
        } else {
            echo "Erro atualizando registro: " . $conn->error;
        }
    }
};


if ($_SERVER['REQUEST_METHOD'] == 'GET') {



     $sql = "SELECT * FROM solucao_linhas";



        $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));
        $emparray = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $emparray[] = $row;
        }

        $R['codigo'] = 0;
        $R['msg'] = "";
        $R['dados'] = $emparray;
        echo json_encode($emparray);

}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    $id = $_GET['del'];

    $sql = " DELETE FROM solucao_linhas WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro apagado com sucesso";
    } else {
        echo "Erro ao tentar apagar registro: " . $conn->error;
    }
};
