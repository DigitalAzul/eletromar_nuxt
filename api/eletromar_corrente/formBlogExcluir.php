<?php
include_once("cnxdb.php");
include_once("param.php");

// ********** FUNCOES ***************

function apagaArquivos($arr_path)
{
    foreach ($arr_path as $arquivo) {
        ini_set('display_errors', 0);
        unlink($arquivo);
    }
    ini_set('display_errors', 1);
}

// ********** FUNCOES ***************



/// PARAM GRAVAR ARQUIVO
$PRE_FIXO = "BLOG_";
$MAX_size = 500000;
$ERROS = array();
$NOME_ARQ_TMP = array();

if ($isDev) {
    $uploaddir = 'C:\Users\x900l\Desktop\MECTRONIC\mectronic_nuxt\public\media\blog\\';
} else {
    $uploaddir = dirname(__DIR__, 1) . "/media/blog/";
}




if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    global  $PRE_FIXO, $MAX_size, $ERROS, $NOME_ARQ_TMP, $isDev;





    if (isset($_POST['blogExcluir']))

        $json = json_decode($_POST['blogExcluir']);
    
        try {
            $id = $json->id;


            $sqlBlogImagens = "SELECT * FROM blog_imagens WHERE blog_id = $id";
            $resultImagem = mysqli_query($conn, $sqlBlogImagens) or die("Error in Selecting " . mysqli_error($connection));
    
            // exclui o post
            $sqlBlogPost = "DELETE FROM blog_posts WHERE id = $id";
            $resultBlogPost = mysqli_query($conn, $sqlBlogPost) or die("Error in Selecting " . mysqli_error($connection));
    
            // exclui as imagens do post
            $sqlBlogPostImagens = "DELETE FROM blog_imagens WHERE blog_id = $id";
            $resultBlogPostImagens = mysqli_query($conn, $sqlBlogPostImagens) or die("Error in Selecting " . mysqli_error($connection));
    

            // exclui as tag do post
            $sqlBlogPostTags = "DELETE FROM tag_post WHERE post_id = $id";
            $resultBlogPostTags = mysqli_query($conn, $sqlBlogPostTags) or die("Error in Selecting " . mysqli_error($connection));

            while ($row = mysqli_fetch_assoc($resultImagem)) {
                //echo($uploaddir . $row['imagem_url']);
               // echo('----');
               // ini_set('display_errors', 0);
                unlink($uploaddir . $row['imagem_url']);
            }
            $R['codigo'] = 0;
            $R['msg'] = "Blog excluído";
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
