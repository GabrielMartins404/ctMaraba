<?php
  session_start()
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Conselho Tutelar Digital Marabá-PA</title>


</head>

<body>
   <?php
    echo"<pre>";
      print_r($HTTP_RAW_POST_DATA);
    echo"</pre>";
?>
</body>
</html>
