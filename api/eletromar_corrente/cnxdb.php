<?php
$emProducao = true;
$LOCAL = "DAZL"; // LOCALHOST | GLOBAL | OCEAN

if($emProducao){
    if($LOCAL == "DAZL"){
        $servername = "mysql.dazl.kinghost.net"; /* pode deixar localhost */
        $username = "dazl"; /* nome do usuario do banco de dados */ 
        $password = "global1sistemas9"; /* senha do banco de dados caso exista senao deixa $password = "" */
        $dbname = "dazl"; /* nome do seu banco de dados*/
    }
    if($LOCAL == "OCEAN"){
        $servername = "localhost"; /* pode deixar localhost */
        $username = "root"; /* nome do usuario do banco de dados */ 
        $password = "@Global159192A"; /* senha do banco de dados caso exista senao deixa $password = "" */
        $dbname = "mectronic"; /* nome do seu banco de dados*/
    }


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