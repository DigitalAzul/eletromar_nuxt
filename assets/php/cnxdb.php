<?php
$emProducao = false;

if($emProducao){
    $servername = "mysql.global.adm.br"; /* pode deixar localhost */
    $username = "global"; /* nome do usuario do banco de dados */ 
    $password = "@Global159192"; /* senha do banco de dados caso exista senao deixa $password = "" */
    $dbname = "global"; /* nome do seu banco de dados*/

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexão falhouW: " . $conn->connect_error);
    } 
  
    }
    else{
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "mectronic";

        $conn = new mysqli(
            $servername,
            $username,
            $password,
            $database
        );

        if ($conn->connect_error) {
            echo("Conexão falhou: " . $conn->connect_error);
            die("Conexão falhou: " . $conn->connect_error);
        };

    }


?>