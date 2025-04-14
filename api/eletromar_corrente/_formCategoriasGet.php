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

    $tipoSql = "";

    if (isset($_GET['q'])) {

        if ($_GET['q'] == 'formBlog') {
            $tipoSql = 1;
        } else {
            $tipoSql = 0;
        }
    }

    
    if($tipoSql == 1){
        $sql = "SELECT * FROM categorias ";
    }else{
        $sql = "SELECT c.id, c.titulo, c.titulo_en, c.titulo_es, categoria_id, COUNT(categoria_id) AS qtd 
        FROM blog_posts AS bp RIGHT JOIN categorias AS c ON bp.categoria_id = c.id 
        GROUP BY categoria_id HAVING COUNT(categoria_id) > 0";
    }



    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $emparray[] = $row;
    }

    $R['codigo'] = 0;
    $R['msg'] = "";
    $R['dados'] = $emparray;
    echo json_encode($R);
    $conn->close();
    exit;

};




if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['json']))
        $json = json_decode($_POST['json']);


    $titulo = $json->titulo;
    $tituloEN = $json->titulo_en;
    $tituloES = $json->titulo_es;


    if ($json->emEdicao == false) {
        $sql = " INSERT INTO tags (titulo, titulo_en, titulo_es) 
        VALUES ('$titulo', '$tituloEN', '$tituloES')";


        if ($conn->query($sql) === TRUE) {
            $R['codigo'] = 0;
            $R['msg'] = "Tag registrada com sucesso!";
            $R['dados'] = "";
            echo json_encode($R);
            exit;
        } else {
            $R['codigo'] = 1;
            $R['msg'] = "Erro no registro da Tag";
            $R['dados'] = "";
            echo json_encode($R);
            exit;
        }
    }

    // UPADATE
    if ($json->emEdicao == true) {
        $id = $json->id;

        $sql = "UPDATE categorias SET titulo='$titulo', titulo_en='$tituloEN', titulo_es='$tituloES'
        WHERE id = $id";


        if ($conn->query($sql) === TRUE) {
            $R['codigo'] = 0;
            $R['msg'] = "Tag registrada com sucesso!";
            $R['dados'] = "";
            echo json_encode($R);
            exit;
        } else {
            $R['codigo'] = 1;
            $R['msg'] = "Erro no registro da Tag";
            $R['dados'] = "";
            echo json_encode($R);
            exit;
        }
    }

}
