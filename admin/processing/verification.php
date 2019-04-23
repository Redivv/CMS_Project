<?php
  function verification(int $accessLevel) : void{
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION['role'] < $accessLevel){      // jeśli przypadkiem użytkownik jest już zalogowany na sesji to przenosi go na stronę główną
      header("location: index.php");
      exit;        // dosłownie - ekwiwalent do die() i vice versa -_-
    }
    session_abort();
  }
 ?>
