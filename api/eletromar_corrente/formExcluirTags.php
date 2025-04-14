<?php
include_once("cnxdb.php");
include_once("param.php");








if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    global  $PRE_FIXO, $MAX_size, $ERROS, $NOME_ARQ_TMP, $isDev;





    if (isset($_POST['json']))

        $json = json_decode($_POST['json']);
    
        try {
            $id = $json->id;

            // ECLUI TAGS
            $sqlTags = "DELETE FROM tags WHERE id = $id";
            $resultsqlTags = mysqli_query($conn, $sqlTags) or die("Error in Selecting " . mysqli_error($connection));
    

            // EXCLUI POST TAGS
            
            $sqlTags_post = "DELETE FROM tag_post WHERE tag_id = $id";
            $resultsqlTagsPost = mysqli_query($conn, $sqlTags_post) or die("Error in Selecting " . mysqli_error($connection));
    

          
            $R['codigo'] = 0;
            $R['msg'] = "Tag excluída";
            $R['dados'] = '';
           echo json_encode($R);
        } catch (\Throwable $th) {
             $R['codigo'] = 1;
             $R['msg'] = "Erro atualizando registro: " . $th;
             $R['dados'] = '';
            echo json_encode($R);
        }

        
      
        exit;
    
};



if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    $id = $_GET['del'];

   
    while ($row = mysqli_fetch_assoc($result)) {

    }
    $sql = " DELETE FROM blog_posts WHERE id = $id";

    echo ($sql);

    foreach ($json->imgParaExcluir as $img) {

        // exclui do banco
        $blogImgSql = "DELETE FROM blog_imagens WHERE imagem_url = '$img'";
        $conn->query($blogImgSql);

       
        //exclui do io
        ini_set('display_errors', 0);
        unlink($uploaddir . $img);
    }

    if ($conn->query($sql) === TRUE) {
        echo "Registro apagado com sucesso";
    } else {
        echo "Erro ao tentar apagar registro: " . $conn->error;
    }

    $conn->close();
};
