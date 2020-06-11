<?php

    $name = "1000Womenapp";
    $value = 100;
    $expiraion = time() + (60 * 60 * 24 * 7) ;
    setcookie($name, $value, $expiraion);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookies</title>
</head>
<body>
    
  <?php  if(isset($_COOKIE["1000Womenapp"])){
      
      $someOne = $_COOKIE["1000Womenapp"];
      echo $someOne;

  }else{
    $someOne = "";
  }
  ?>
</body>
</html>