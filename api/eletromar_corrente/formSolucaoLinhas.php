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

        //GRAVA ARQUIVOS
        if ($isDev) {
            $uploaddir = 'C:\Users\x900l\Desktop\MECTRONIC\mectronic_nuxt\public\media\solucoes\linhas_destaque\\';
        } else {
            $uploaddir = dirname(__DIR__, 1) . "/media/solucoes/linhas_destaque/";
        }

        

    $json = json_decode($_POST['json']);



    $titulo = $json->titulo;
    $link = $json->link;
    $ativo = $json->ativo;
    $descricao = $json->descricao;
    $descricao_en = $json->descricao_en;
    $descricao_es = $json->descricao_es;
    $uploadfilePath = "";
    $ordem = $json->ordem;


    $descricao = addslashes($descricao);
    $descricao_en = addslashes($descricao_en);
    $descricao_es = addslashes($descricao_es);

    

    if (isset($_FILES[0])) {
        $path = $_FILES[0]['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $uploadfilePath = $uploaddir .  $link . '.' . $ext;


        if (false === $ext = array_search(
            $finfo->file($_FILES[0]['tmp_name']),

            array(
                'mp4' => 'video/mp4',
            ),
            true
        )) {
            throw new RuntimeException('Tipo de arquivo invalido (JPEG, PNG)');
        }else{
            try {
                if(file_exists($uploadfilePath)) {
                    unlink($uploadfilePath); //remove the file
                }
                move_uploaded_file($_FILES[0]['tmp_name'], $uploadfilePath);
            } catch (\Throwable $th) {
                echo $th;
            }
        }
    }





    if ($json->emEdicao == false) {
        $sql = " INSERT INTO solucao_linhas (titulo, link, descricao, descricao_en, descricao_es, ativo, ordem) VALUES ('$titulo', '$link', '$descricao', '$descricao_en', '$descricao_es', $ativo, $ordem)";

        if ($conn->query($sql) === TRUE) {
            echo "Registro inserido com sucesso";
            exit;
        } else {
            echo "Erro ao inserir registro: " . $conn->error;
        }
    }else{
        $id = $json->id;
        $sql = " UPDATE solucao_linhas SET titulo='$titulo', link='$link', descricao='$descricao', descricao_en='$descricao_en', descricao_es='$descricao_es', ativo=$ativo, ordem=$ordem WHERE id = $id ";

        if ($conn->query($sql) === TRUE) {
            echo "Registro atualizado com sucesso";
        } else {
            echo "Erro atualizando registro: " . $conn->error;
        }
    }
};


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

   $_WHERE = "";
   if($_GET['ativo']){
    if($_GET['ativo'] == "s"){
        $_WHERE = "WHERE ativo = '1'";
    }
    if($_GET['ativo'] == "n"){
        $_WHERE = "WHERE ativo = '0'";
    }
    if($_GET['ativo'] == "t"){
        $_WHERE = "";
    }
   }

   

     $sql = "SELECT * FROM solucao_linhas $_WHERE ORDER BY ordem ASC";
  
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

    $id = $_GET['d'];




    try {
        $sql = " DELETE FROM solucao_linhas WHERE id = $id";
       $conn->query($sql);
    } catch (\Throwable $th) {
        echo "Erro ao tentar apagar registro: " . $conn->error;
        exit;
    }
    
    try {
        $sql = " DELETE FROM solucoes WHERE linha_id = $id";
        $conn->query($sql);
    } catch (\Throwable $th) {
        echo "Erro ao tentar apagar registro: " . $conn->error;
        exit;
    }



        echo "Registro excluído com sucesso";

};
