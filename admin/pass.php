<?php include 'includes/db_conn.php'; ?>
<?php

  $password_err = $confirm_password_err = '';

  if ((isset($_GET['id'])) && (isset($_GET['hash']))) {
    $user_id = $_GET['id'];
    $user_hash = $_GET['hash'];
    $query = "SELECT * FROM users WHERE id = {$user_id} AND hash = '$user_hash'";
    if ($result = mysqli_query($link,$query)) {
      if (mysqli_num_rows($result) === 1) {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

          // Walidacja Hasła
          if(empty(trim($_POST["password"]))){
            $password_err = "Podaj hasło";
          }elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "Hasło musi mieć przynajmniej 6 znaków";
          }else{
            $password = trim($_POST["password"]);
          }

          // Walidacja Potwierdzenia Hasła
          if(empty(trim($_POST["confirm_password"]))){
              $confirm_password_err = "Potwierdź hasło";
          }else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){      // aby walidacja się powiodła hasło musi być dobrze wprowadzone i identycznie z potwierdzeniem
              $confirm_password_err = "Hasła się nie zgadzają";
            }
          }

          if(empty($password_err) && empty($confirm_password_err)){      // Po walidacji sprawdzane jest istnienie błedów

              $ready_password = password_hash($password, PASSWORD_DEFAULT);   // Hasło jest hashowane za pomocą funkcji (algorytm DEFAULT jest zmienianiy i ulepszany z wersji na wersję)

              $query = "UPDATE `users` SET `users`.`password` = '$ready_password', `users`.`hash` = NULL WHERE `users`.`id` = {$user_id};";      // po zdanej walidacji przygtowujemy INSERT do bazy danych

              if(mysqli_query($link,$query)){
                header('location:logout.php');
              }else{
                $password_err = "Wystąpił Błąd ".mysqli_error($link);     // a jak nie to nie
              }
          }
        }
      }else{
        header('location:index.php');
      }
    }else{
      header('location:index.php');
    }
  }else{
    header('location:index.php');
  }

 ?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <?php include "includes/header_html.php"; ?>
</head>

<body style="background-color:#ffffff">
  <div class="container">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?'.htmlspecialchars($_SERVER['QUERY_STRING']); ?>">
      <div class="form-group">
        <label for="">Nowe Hasło</label>
        <input type="password" name="password" class="form-control">
        <div class="error-block"><?php echo $password_err; ?></div>
      </div>
      <div class="form-group">
        <label for="">Potwierdź Hasło</label>
        <input type="password" name="confirm_password" class="form-control">
        <div class="error-block"><?php echo $confirm_password_err; ?></div>
      </div>
      <button type="submit" name="change_pass" class="btn btn-danger">Zmień Hasło</button>
    </form>
  </div>
</body>

</html>
