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

    //$data = json_decode(file_get_contents('php://input'), true);
    parse_str(file_get_contents("php://input"),$post_vars);
    var_dump($post_vars);


    exit;
    $id = $_GET['id'];
    $nome = $data['nome'];
    $criado_em = $data['criado_em'];
    $comentario = $data['comentario'];
    $email = $data['email'];
    $local = $data['local'];
    $imagemURL = $data['imagemURL'];


    $sql = "UPDATE comentarios SET nome='$nome', criado_em='$criado_em', comentario='$comentario', email='$email', localidade='$local', imagem_url='$imagemURL' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro atualizando registro: " . $conn->error;
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $json = json_decode($_POST['json']);

    $blog_posts_id = $json->blog_posts_id;
    $nome = $json->nome;
    $criado_em = $json->criado_em;
    $comentario = $json->comentario;
    $email = $json->email;
    $local = $json->localidade;
    $ativado = $json->ativado;
    $imagemURL = $json->imagem_url;
    $resposta = $json->resposta;

    if($json->emEdicao == false){
        $criado_em = date("Y-m-d");
        $sql = " INSERT INTO comentarios (blog_posts_id, nome, criado_em, comentario, email, localidade, imagem_url, ativado) 
        VALUES ('$blog_posts_id','$nome', '$criado_em', '$comentario', '$email', '$local', '$imagemURL', '$ativado')";

        if ($conn->query($sql) === TRUE) {
            $R['codigo'] = 0;
            $R['msg'] = "Registro inserido com sucesso";
            $R['dados'] = ""; 
            echo json_encode($R);
        } else {
            echo "Erro ao inserir registro: " . $conn->error;
        }
    }else{
        
        $id = $json->id;
        $sql = "UPDATE comentarios SET nome='$nome', criado_em='$criado_em', comentario='$comentario', email='$email', localidade='$local', imagem_url='$imagemURL', resposta='$resposta', ativado='$ativado' WHERE id = $id";
    
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




if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    $id = $_GET['del'];

    $sql = " DELETE FROM comentarios WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro apagado com sucesso";
    } else {
        echo "Erro ao tentar apagar registro: " . $conn->error;
    }
};
