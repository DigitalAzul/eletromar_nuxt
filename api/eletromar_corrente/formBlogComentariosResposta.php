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




if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $json = json_decode($_POST['json']);


    $comentarios_id = $json->id;
    $respostaOBJ = $json->resposta[0];
    $criado_em = date("Y-m-d");
    $resposta = $respostaOBJ->texto;


    if($json->emEdicao == false){
        
        $sql = " INSERT INTO resposta_comentario (comentarios_id, texto, criado_em) 
        VALUES ('$comentarios_id','$resposta', '$criado_em')";

        if ($conn->query($sql) === TRUE) {
            $R['codigo'] = 0;
            $R['msg'] = "Registro inserido com sucesso". $conn->error;;
            $R['dados'] = ""; 
            echo json_encode($R);
        } else {
            echo "Erro ao inserir registro: " . $conn->error;
        }
    }else{
        
        $id = $json->id;
        $sql = "UPDATE resposta_comentario SET resposta='$resposta', criado_em='$criado_em' WHERE id = $id";
    
        if ($conn->query($sql) === TRUE) {
            echo "Registro atualizado com sucesso";
        } else {
            echo "Erro atualizando registro: " . $conn->error;
        }
    }
};




if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['todos'])) {

        $sql = " SELECT * FROM comentarios  ORDER BY id";

        $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

        $emparray = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $emparray[] = $row;
        }

        echo json_encode($emparray);
    }
};


