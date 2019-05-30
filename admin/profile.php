<?php include 'includes/db_conn.php'; ?>
<?php include 'processing/verification.php'; verification(1); ?>
<?php
  session_start();
  $profile_error = '';
  $user_id = $_SESSION['id'];

  if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $selected_tab = (isset($_POST['send_form']) === true) ? $_POST['send_form'] : '';
    switch ($selected_tab) {
      case 'idInfo':
        if (isset($_FILES['avatar'])) {
          if ($_FILES['avatar']['error'] === 0) {
            if ($_FILES['avatar']['size'] <= 5000000) {
              $profile_error = "Dane zapisano";
              $new_avatar = upload_image($_FILES['avatar']);
              $query = "UPDATE `users` SET `users`.`thumbnail` = '$new_avatar' WHERE `users`.`id` = {$user_id};";
              if (mysqli_query($link,$query)){
                if (mysqli_affected_rows($link) === 1) {
                  $current_thumb = $_SESSION['thumb'];
                  if ($current_thumb != "normal_thumb.png") {
                    unlink("../img/uploads/".$current_thumb);
                  }
                  $_SESSION['thumb'] = $new_avatar;
                }else{
                  $profile_error = "Wystąpił Bład";
                  unlink("../img/uploads/".$new_avatar);
                }
              }else{
                $profile_error = "Wystąpił Bład ".mysqli_error($link);
                unlink("../img/uploads/".$new_avatar);
              }
            }else{
              $profile_error = "Przesłany plik za dużo waży!";
            }
          }else{
            $profile_error = "Wystąpił bład ".$_FILES['avatar']['error'];
          }
        }
        break;
      case 'loginInfo':
        if (isset($_POST['login_user'])) {
          $new_username = mysqli_real_escape_string($link,$_POST['login_user']);
          if (empty(trim($new_username))){
            $profile_error = "Nazwa Użytkownika nie może być pusta";
          }else{
            $query = "UPDATE `users` SET `users`.`username` = '$new_username' WHERE `users`.`id` = {$user_id};";
            if (mysqli_query($link,$query)) {
              $_SESSION['username'] = htmlspecialchars($new_username);
              $profile_error = "Dane zapisano";
            }else{
              $profile_error = "Wystąpił Bład - ".mysqli_error($link);
            }
          }
        }
        break;
      case 'change_pass':
        $hash = bin2hex(random_bytes(rand(10,32)));
        $query = "UPDATE `users` SET `users`.`hash` = '$hash' WHERE `users`.`id` = {$user_id};";
        if (mysqli_query($link,$query)) {
          $email = $_SESSION['email'];
          $msg = "Naciśnij link aby potwierdzić zmianę hasła : <a href='http://port.loc/admin/pass.php?id=".$_SESSION['id']."&hash=".$hash."'>Potwierdź Zmianę Hasła</a>";
          $title = "Gliniane Dzbany Blog - Zmiana Hasła";
          if(send_verification_mail('localmail@localhost',$title,$msg)){
            $profile_error = 'Na adres email został wysłany mail z potwierdzeniem zmiany hasła';
          }else{
            $profile_error = "Wystąpił Bład. Proszę spróbować później";
          }
        }else{
          $profile_error = "Wystąpił Bład ".mysqli_error($link);
        }
        break;
      case 'addInfo':
        if((isset($_POST['first-name'])) && (isset($_POST['last-name']))){
          $first_name = (!empty(trim($_POST['first-name']))) ? mysqli_real_escape_string($link,$_POST['first-name']) : '';
          $last_name = (!empty(trim($_POST['last-name']))) ? mysqli_real_escape_string($link,$_POST['last-name']) : '';
          $query = "UPDATE `users` SET `users`.`first_name` = '$first_name', `users`.`last_name` = '$last_name' WHERE `users`.`id` = {$user_id}; ";
          if (mysqli_query($link,$query)) {
            $profile_error = "Dane zapisano";
          }else {
            $profile_error = "Wystąpił Bład - ".mysqli_error($link);
          }
          break;
        }else{
          $profile_error = "Wystąpił błąd";
        }
      case 'mailInfo':
        if ((empty(trim($_POST['new_email']))) || ($_POST['new_email'] === $_SESSION['email'])) {
          $profile_error = "Podaj nowy adres Email";
        }else{
          $param_email = trim($_POST['new_email']);
          $query = "SELECT id FROM users WHERE email = '$param_email'";
          if($result = mysqli_query($link,$query)){      // próbuję wykonać zapytanie
              if(mysqli_num_rows($result) == 1){
                  $profile_error = "Ten adres email jest już powiązany z kontem";      // jeśli znaleziono username - przypisać bład
              }else{
                if (filter_var($_POST['new_email'], FILTER_VALIDATE_EMAIL)){
                  $email = trim($_POST["new_email"]);      // w przeciwnym razie mamy gotowy email
                  $hash = bin2hex(random_bytes(rand(10,32)));
                  $query = "UPDATE `users` SET `users`.`hash` = '$hash', `users`.`last_email` = '$email' WHERE `users`.`id` = {$user_id};";
                  if (mysqli_query($link,$query)) {
                    $msg = 'Naciśnij link aby potwierdzić zmianę adresu email : <a href="http://port.loc/admin/mail.php?id='.$_SESSION['id'].'&hash='.$hash.'">Link Potwiedzający </a>';
                    $title = "Gliniane Dzbany Blog - Zmiana Hasła";
                    if(send_verification_mail('localmail@localhost',$title,$msg)){
                      $profile_error = 'Na podany nowy adres email został wysłany mail z potwierdzeniem zmiany adresu email';
                    }else{
                      $profile_error = "Wystąpił Bład. Proszę spróbować później";
                    }
                  }else{
                    $profile_error = "Wystąpił Bład ".mysqli_error($link);
                  }
                }else {
                  $profile_error = "Niepoprawny adres email";
                }
              }
          }else{
              $profile_error = "Wystąpił bład";      // ogólny błąd jeśli coś pierdolnie
          }
        }
        break;
      default:
        $profile_error = "Wystąpił bład";
        break;
    }
  }

  $query = "SELECT `users`.`first_name`, `users`.`last_name`, `users`.`email` FROM `users` WHERE `users`.`id` = {$user_id};";
  if ($result = mysqli_query($link,$query)) {
    $data = mysqli_fetch_assoc($result);
  }else{
    $profile_error = mysqli_error($link);
  }



 ?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <?php include "includes/header_html.php"; ?>
</head>

<body>

    <div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>
    <!-- /.Navigation -->

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Header -->
                <?php include 'includes/header.php'; create_header('Profil', $_SESSION['username']); ?>
                <!-- /.Header -->

                <!-- Content -->
                <?php include "includes/sections/profile_content.php"; ?>
                <!-- /.Content -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /.page-wrapper -->

    </div>
    <!-- /.wrapper -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>

</body>

</html>
