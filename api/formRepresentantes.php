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
    $nome = $data['nome'];
    $estabelecimento = $data['estabelecimento'];
    $contato = $data['contato'];


    $sql = " UPDATE representantes SET nome='$nome', estabelecimento='$estabelecimento', contato='$contato' WHERE id = $id ";

    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro atualizando registro: " . $conn->error;
    }
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $json = json_decode($_POST['json']);

    $estabelecimento = $json->estabelecimento;
    $contato = $json->contato;
    $uf = $json->uf;


    if($json->emEdicao == false){
        $sql = " INSERT INTO representantes (estabelecimento, contato, uf) VALUES ('$estabelecimento', '$contato', '$uf')";

        if ($conn->query($sql) === TRUE) {
            echo "Registro inserido com sucesso";
        } else {
            echo "Erro ao inserir registro: " . $conn->error;
        }
    }else{
        $id = $json->id;
        $sql = " UPDATE representantes SET estabelecimento='$estabelecimento', contato='$contato', uf='$uf' WHERE id = $id ";

        if ($conn->query($sql) === TRUE) {
            echo "Registro atualizado com sucesso";
        } else {
            echo "Erro atualizando registro: " . $conn->error;
        }
    }

    
};


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $json = json_decode($_GET['json']);
    $q = $json->q;

    if($q == 'todos'){
        $sql = " SELECT * FROM representantes";  
    }
    if($q == 'por_uf'){
        $uf =$json->uf;
        $sql = " SELECT * FROM representantes WHERE uf = '$uf'";  
    }



    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $emparray[] = $row;
    }

    if(count($emparray) > 0){
        $R['codigo'] = 0;
        $R['msg'] = "";
        $R['dados'] = $emparray;
    }else{
        $R['codigo'] = 1;
        $R['msg'] = "Sem registros" . $conn->error;;
        $R['dados'] = "";
    }

    echo json_encode($R);
    
};

if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){

    $id = $_GET['del'];

    $sql = " DELETE FROM representantes WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro apagado com sucesso";
    } else {
        echo "Erro ao tentar apagar registro: " . $conn->error;
    }
};