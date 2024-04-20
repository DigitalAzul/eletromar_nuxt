<?php

include_once("cnxdb.php"); 
include_once("param.php"); 

$PRE_FIXO = "VITAE_";
$MAX_size = 500000;
$ERROS = array();
$NOME_ARQ_TMP = array();


    //GRAVA ARQUIVOS
    if($isDev){
        $uploaddir = 'C:\Users\x900l\Desktop\MECTRONIC\mectronic_nuxt\public\media\arquivos\\';
    }else{
        $uploaddir = dirname(__DIR__,1)."/media/arquivos/";
    }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (isset($_POST['json'])){
        $json = json_decode($_POST['json']);
        }


    if ($json->origem == "FormCurriculo" && isset($_FILES[0])) {
        $arquivo = $_FILES[0]['name'];



        $path = $_FILES[0]['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $finfo = new finfo(FILEINFO_MIME_TYPE);

        if (false === $ext = array_search(
            $finfo->file($_FILES[0]['tmp_name']),

            array(
                'pdf' => 'application/pdf'
            ),
            true
        )) {
            $R['codigo'] = 1;
            $R['msg'] = "Tipo de arquivo invalido (PDF)";
            $R['dados'] = "";
            echo json_encode($R);
            exit;
        }

        $date = new DateTimeImmutable();
        $micro = (int)$date->format('U');
        $RAND = rand(1000000,9999999);
        $uploadfilePath = $uploaddir . $PRE_FIXO . $micro . '_'. $RAND .'.' . $ext;
        $uploadfile = $PRE_FIXO . $micro . '_'. $RAND .'.' .  $ext;

        $NOME_ARQ_TMP[0] = $uploadfile;

        try {
            move_uploaded_file($_FILES[0]['tmp_name'], $uploadfilePath);
        } catch (\Throwable $th) {
            $R['codigo'] = 1;
            $R['msg'] = $th;
            $R['dados'] = "";
            echo json_encode($R);
            exit;
        }


        
        $nome = $json->nome;
        $email = $json->email;
        $uf = $json->uf;
        $cidade = $json->cidade;
        $setor = $json->setor;
        $pdf = $uploadfile;
        $comentario = $json->comentario;
        $politica = $json->politica;

        $sql = "INSERT INTO curriculo (nome, email, uf, cidade, setor, pdf, comentario, politica)
                VALUES ('$nome','$email','$uf','$cidade','$setor','$pdf','$comentario','$politica' )";

            if ($conn->query($sql) === TRUE ){
                $R['codigo'] = 0;
                $R['msg'] = "Seu Curriculo foi recebido!";
                $R['dados'] = "";
                echo json_encode($R);
                exit;
            } else {
                $R['codigo'] = 1;
                $R['msg'] = "Falha ao receber seu Curriculo, tente novamente!";
                $R['dados'] = "";
                echo json_encode($R);
                exit;
            }





    }

    if ($json->origem == "formContato"){


        $nome = $json->nome;
        $email = $json->email;
        $uf = $json->uf;
        $cidade = $json->cidade;
        $empresa = $json->empresa;
        $cnpj = $json->cnpj;
        $mensagem = $json->mensagem;
        $politica = $json->politica;
        
        $sql = "INSERT INTO contato (nome, email, uf, cidade, empresa, cnpj, mensagem, politica)
                VALUES ('$nome','$email','$uf','$cidade','$empresa','$cnpj','$mensagem', '$politica' )";

            if ($conn->query($sql) === TRUE ){
                $R['codigo'] = 0;
                $R['msg'] = "Contato recebido!";
                $R['dados'] = "";
                echo json_encode($R);
                exit;
            } else {
                $R['codigo'] = 1;
                $R['msg'] = "Ocorreu um erro ao receber seu Contato!";
                $R['dados'] = "";
                echo json_encode($R);
                exit;
            }



    }

    }

// Get mail


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $json = json_decode($_GET['json']);
    $q = $json->q;


  
    if ($json->origem == "FormCurriculo"){

  
    if($q == 'todos'){
        $sql = "SELECT  c.*, s.label FROM curriculo AS c INNER JOIN setores AS s ON c.setor = s.id";  
    }
    elseif($q == 'setor'){
        $setor = $json->setor;
        $sql = " SELECT  c.*, s.label FROM curriculo AS c INNER JOIN setores AS s ON c.setor = s.id  WHERE c.setor = $setor";  

    }elseif($q == 'delete'){
        $setor = $json->setor;
        $sql = "DELETE FROM setores WHERE id = $setor";

        $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));
        $R['codigo'] = 0;
        $R['msg'] = "Setor excluído";
        $R['dados'] = "";
        echo json_encode($R);
        exit;
    }


    // if($q == 'por_email'){
    //     $email = $json->email;
    //     $sql = " SELECT * FROM curriculo WHERE email = '$email'";  
    // }


    // if($json->dataInicio && $json->dataFim) {
    //     $dataInicio = $json->dataInicio;
    //     $dataFim = $json->dataFim;
    //     $between = " BETWEEN ('$dataInicio') AND ('$dataFim')";

    //     $sql = "SELECT * FROM curriculo WHERE $between";

    // }




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

    exit;
    }



    if ($json->origem == "formContato"){


        $json = json_decode($_GET['json']);
        $q = $json->q;
    
        if($q == 'todos'){
            $sql = " SELECT * FROM contato ORDER BY uf ASC";  
        }
        if($q == 'por_empresa'){
            $empresa = $json->empresa;
            $sql = " SELECT * FROM contato WHERE empresa = '$empresa'";  
        }
        if($q == 'por_cnpj'){
            $cnpj = $json->cnpj;
            $sql = " SELECT * FROM contato WHERE cnpj = '$cnpj'";  
        }

        if($q == 'por_uf_count'){

            $sql = " SELECT  uf,  COUNT(uf) AS qtd from contato
            GROUP BY uf";  
        }

        if($q == 'por_uf'){
            $uf = $json->uf;
            $sql = " SELECT * from contato WHERE uf = '$uf'";  
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


        exit;
    }








    








}







// recipient email address
$to = "suporte@digitalazul.com.br";

// subject of the email
$subject = "Contato web site Mectronic";

// message body
$message = "<h1>Contato web site</h1>";

// from
$from = "suporte@digitalazul.com.br";

// boundary
$boundary = uniqid();

// header information
$headers = "From: $from\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\".$boundary.\"\r\n";

// attachment
if (isset($_FILES[0])) {
$attachment = chunk_split(base64_encode(file_get_contents('file.pdf')));
}
// message with attachment
$message = "--".$boundary."\r\n";
$message .= "Content-Type: text/plain; charset=UTF-8\r\n";
$message .= "Content-Transfer-Encoding: base64\r\n\r\n";
$message .= chunk_split(base64_encode($message));
$message .= "--".$boundary."\r\n";
$message .= "Content-Type: application/octet-stream; name=\"file.pdf\"\r\n";
$message .= "Content-Transfer-Encoding: base64\r\n";
$message .= "Content-Disposition: attachment; filename=\"file.pdf\"\r\n\r\n";
if (isset($_FILES[0])) {
$message .= $attachment."\r\n";
}
$message .= "--".$boundary."--";

// send email
if (mail($to, $subject, $message, $headers)) {
    echo "Email with attachment sent successfully.";
} else {
    echo "Failed to send email with attachment.";
}
