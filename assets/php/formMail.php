<?php
// Multiple recipients
$to = 'suporte@digitalazul.com.br, financeiro@digitalazul.com.br'; // note the comma

// Subject
$subject = 'Contato do site Mectronic';
$dataHoje = "";
// Message
$message = '
<html>
<head>
  <title>Site Mectronic</title>
</head>
<body>
  <p>Em $dataHoje</p>
  <table>
    <tr>
      <th>Nome</th><th>Email</th><th>Estado</th><th>Cidade</th><th>Empresa</th><th>CNPJ</th><th>Comentario</th>
    </tr>
    <tr>
      <td>Johny</td><td>10th</td><td>August</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
    </tr>
  </table>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';

// Additional headers
$headers[] = 'To: Site <suporte@digitalazul.com.br>';
$headers[] = 'From: Site <suporte@digitalazul.com.br>';


// Mail it
echo mail($to, $subject, $message, implode("\r\n", $headers));
?>