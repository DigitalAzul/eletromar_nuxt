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


function getAgora() {
    $tz_object = new DateTimeZone('Brazil/East');
    //date_default_timezone_set('Brazil/East');

    $datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    return $datetime->format('Y\-m\-d\ h:i:s');
}



if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

    $data = json_decode(file_get_contents('php://input'), true);

    $id = $_GET['id'];
    $nome = $data['nome'];
    $email = $data['email'];


    $sql = " UPDATE newsletter SET nome='$nome', email='$email' WHERE id = $id ";

    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro atualizando registro: " . $conn->error;
    }
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $json = json_decode($_POST['json']);
    
    $nome = $json->nome;
    $email = $json->email;
    $data = getAgora();

    $sql = " INSERT INTO newsletter (nome, email, criado_em) VALUES ('$nome', '$email', '$data')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro inserido com sucesso";
    } else {
        echo "Erro ao inserir registro: " . $conn->error;
    }
};




if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    
    $whereQuery = "";
    $offset = "";
    $qpag = "";
    $xLimit = "";
    $dataInicio = "";
    $dataFim = "";
    $between = "";

    if(isset($_GET['dataInicio']) && isset($_GET['dataFim'])) {
        $dataInicio = $_GET['dataInicio'];
        $dataFim = $_GET['dataFim'];
        $between = " BETWEEN ('$dataInicio') AND ('$dataFim')";
    }

    if(isset($_GET['q'])) {
        $q = $_GET['q'];
        $whereQuery = "(LOWER(nome) LIKE LOWER('%$q%') OR LOWER(email) LIKE LOWER('%$q%')) AND criado_em $between";
    }



    if(isset($_GET['offset'])) $offset = $_GET['offset'];
    if(isset($_GET['qpag'])) $qpag = $_GET['qpag'];
    


    if ($offset > -1 && $qpag > 0) {
        $xLimit = "LIMIT $offset, $qpag";
    } else {
        $xLimit = '';
    }
    

    $sql = "SELECT * FROM newsletter WHERE $whereQuery $xLimit";


    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $emparray[] = $row;
    }

    echo json_encode($emparray);
};





if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){

    $id = $_GET['del'];

    $sql = " DELETE FROM newsletter WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro apagado com sucesso";
    } else {
        echo "Erro ao tentar apagar registro: " . $conn->error;
    }
};