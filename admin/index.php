<?php require 'includes/db_conn.php'; ?>
<?php
session_start();      // rozpoczynamy sesję

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){      // jeśli przypadkiem użytkownik jest już zalogowany na sesji to przenosi go na stronę główną
  header("location: dashboard.php");
  exit;        // dosłownie - ekwiwalent do die() i vice versa -_-
}

$username = $password = "";        // definiujemy puste zmienne (dobra praktyka zamiast if isset)
$username_err = $password_err = "";

if ($_SERVER['REQUEST_METHOD'] === "GET") {
  if ((isset($_GET['id']) && (isset($_GET['code'])))) {
    if ((!empty(trim($_GET['id']))) && (!empty(trim($_GET['code'])))) {
      $user_id = intVal($_GET['id']);
      $hash = $_GET['code'];
      if(mysqli_query($link,"UPDATE `users` SET `users`.`role` = 2, `users`.`hash` = NULL WHERE `users`.`id`= {$user_id} AND `users`.`hash` = '$hash' AND `users`.`ban_date` = '0000-00-00'; ")){
        $username_err = "Konto Zostało Aktywowane";
      }else{
        $username_err = "Błedne Dane";
      }
    }
  }
}

if($_SERVER["REQUEST_METHOD"] === "POST"){

  if(empty(trim($_POST["username"]))){        // sprawdzam  czy username jest pusty
      $username_err = "Podaj login";
  }else{
      $username = mysqli_real_escape_string($link,trim($_POST["username"]));
  }

  if(empty(trim($_POST["password"]))){    // sprawdzam czy password jest pusty
      $password_err = "Podaj hasło";
  } else{
      $password = trim($_POST["password"]);
  }

  // Walidacja konta
  if(empty(trim($username_err)) && empty(trim($password_err))){

      $query = "SELECT `users`.`id`, `users`.`username`, `users`.`password`,`users`.`role`, `users`.`thumbnail`, `users`.`email`, `users`.`ban_date` FROM `users` WHERE `users`.`username` = '$username' OR `users`.`email` = '$username'";    // przygotowuję zapytanie do wyszukania danych użytkownia po UNIKALNYM username

      if($result = mysqli_query($link,$query)){

             if(mysqli_num_rows($result) == 1){      // jeśli konto z daną nazwą istnieje to zaczynamy weryfikować hasło
                 if($row = mysqli_fetch_assoc($result)){
                     $id = $row["id"];    // przypisujemy pobrane dane do zmiennych
                     $username = $row["username"];
                     $hashed_password = $row["password"];
                     $role = $row['role'];
                     $img = $row['thumbnail'];
                     $email = $row['email'];
                     $ban_date = $row['ban_date'];
                     if(password_verify($password, $hashed_password)){    // jako że hash i sól znajdują się w bazie danych to wystarczy funkcją verivy porównać hasło zwykłe z już zahashowanym
                         $_SESSION["loggedin"] = true;    // użytkownik jest zalogowany
                         $_SESSION["id"] = intVal($id);   // id sesji (jak i użytkownika)
                         $_SESSION["username"] = htmlspecialchars($username);  // zalogowany użytkownik
                         if(($ban_date != '0000-00-00') && ($ban_date <= date('Y-m-d'))){ // jeśli Twój ban minął, zmień role
                          $query = "UPDATE users SET role = 2, ban_date = '0000-00-00' WHERE id = {$id}";
                          mysqli_query($link,$query);
                          $_SESSION['role'] = 2;
                          $query = "DELETE FROM notifications WHERE type = 1 AND receipient = {$id}";
                          mysqli_query($link,$query);
                          $query = "INSERT INTO notifications VALUES ({$id},4,NULL,0)";
                          mysqli_query($link,$query);
                         }else{
                          $_SESSION['role'] = intVal(htmlspecialchars($role));
                         }
                         $_SESSION['thumb'] = htmlspecialchars($img);
                         $_SESSION['email'] = htmlspecialchars($email);

                         header("location: ../index.php");  // przeniesienie na admina
                     }else{
                         $password_err = "Hasło jest nieprawidłowe";    // jeśli hasła się nie zgadzają to nie się nie zgadzają
                     }
                 }
             }else{
                 $username_err = "Nie znaleziono konta z daną nazwą bądź jest ono nieaktywne";    // jeśli nie znaleziono wgl takiego użytkownika to go nie znaleziono
             }
     }else{
       echo "Wystąpił błąd <br>".mysqli_error($link);
     }
  }
  // /.Walidacja Konta
}

?>
<!DOCTYPE html>
<html lang="pl">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>SB Admin - Bootstrap Admin Template</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/sb-adminLogin.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>
  <div class="container">
    <div class="row">
      <h2>Login</h2>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">   <!-- htmlspecialchars zmienia magiczne znaki (np tagi) na zwykłe a w $_SERVER['PHP_SELF'] znajduje się aktualny adres więc tutaj w bezpieczny sposób oznaczamy że formularz będzie przerabiany na tej samej stronie -->
      <div class="form-group">
        <label for="">Nazwa użytkownika lub Email</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
        <div class="error-block"><?php echo $username_err; ?></div>
      </div>
      <div class="form-group">
        <label for="">Hasło</label>
        <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
        <div class="error-block"><?php echo $password_err; ?></div>
      </div>
      <button class="btn btn-block btn-primary" type="submit" name="send_form">Zaloguj się</button>
    </form>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <h4>Nie masz konta?</h4>
        <a class="btn btn-primary" href="singup.php">Zarejestruj Się</a>
      </div>
    </div>
    <div class="row" style="margin-top:1%;">
      <div class="col-md-12">
        <a class="btn btn-primary" href="../">Wróć na stronę główną</a>
      </div>
    </div>
  </div>
</body>

</html>
