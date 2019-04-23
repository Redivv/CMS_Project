<?php require 'includes/db_conn.php'; ?>
<?php
  session_start();

  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){      // jeśli przypadkiem użytkownik jest już zalogowany na sesji to przenosi go na stronę główną
    header("location: dashboard.php");
    exit;        // dosłownie - ekwiwalent do die() i vice versa -_-
  }

  $username = $mail = $password = $confirm_password = "";        // inicjujemy puste zmienne
  $username_err = $email_err = $password_err = $confirm_password_err = "";

  if($_SERVER['REQUEST_METHOD'] == "POST"){

    // Walidacja Nazwy Użytkownika
    if(empty(trim($_POST["user"]))){
        $username_err = "Please enter a username.";      // błąd do wypisania
    } else{

            $param_username = trim($_POST["user"]);      // przypisuje wartość z formularza pod zmienną
            $query = "SELECT id FROM users WHERE username = '$param_username'";

            if($result = mysqli_query($link,$query)){      // próbuję wykonać zapytanie
                if(mysqli_num_rows($result) == 1){
                    $username_err = "Ta nazwa użytkownika jest już zajęta";      // jeśli znaleziono username - przypisać bład
                } else{
                    $username = trim($_POST["user"]);      // w przeciwnym razie mamy gotowy username
                }
            } else{
                echo "Wystąpił bład";      // ogólny błąd jeśli coś pierdolnie
            }
        }
        // /.Walidacja Nazwy Użytkownika

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

        if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){      // Po walidacji sprawdzane jest istnienie błedów

            $param_username = $username;      // zmienne są przypisywane
            $param_password = password_hash($password, PASSWORD_DEFAULT);   // Hasło jest hashowane za pomocą funkcji (algorytm DEFAULT jest zmienianiy i ulepszany z wersji na wersję)

            $query = "INSERT INTO users (username, password) VALUES ('$param_username', '$param_password')";      // po zdanej walidacji przygtowujemy INSERT do bazy danych

            if(mysqli_query($link,$query)){
              header("location: index.php");      // jeśli udało się dodać nowego użytkownika to redirect na stronę logowania
            }else{
              echo "Wystąpił Błąd";     // a jak nie to nie
            }
        }
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
      <h2>Zarejestruj się</h2>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">  <!-- htmlspecialchars zmienia magiczne znaki na htmlowe a w $_SERVER['PHP_SELF'] znajduje się aktualny adres więc tutaj w bezpieczny sposób oznaczamy że formularz będzie przerabiany na tej samej stronie -->
      <div class="form-group">
        <label for="">Nazwa użytkownika</label>
        <input type="text" class="form-control" name="user" value="<?php echo $username; ?>">
        <div class="error-block"><?php echo $username_err; ?></div>
      </div>
      <div class="form-group">
        <label for="">E-mail</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
        <div class="error-block"><?php echo $email_err; ?></div>
      </div>
      <div class="form-group">
        <label for="">Hasło</label>
        <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
        <div class="error-block"><?php echo $password_err;?></div>
      </div>
      <div class="form-group">
        <label for="">Powtórz Hasło</label>
        <input type="password" class="form-control" name="confirm_password" value="<?php echo $confirm_password; ?>">
        <div class="error-block"><?php echo $confirm_password_err;?></div>
      </div>
      <button class="btn btn-block btn-primary" type="submit" name="send_form">Zarejestruj Się</button>
    </form>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <h4>Masz już konto?</h4>
        <a class="btn btn-primary" href="index.php">Zaloguj się</a>
      </div>
    </div>
  </div>
</body>

</html>
