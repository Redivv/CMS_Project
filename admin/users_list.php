<?php include 'includes/db_conn.php'; ?>
<?php include 'processing/verification.php'; verification(3); ?>
<?php

  $user_status = "";

  if($_SERVER['REQUEST_METHOD'] === "GET"){

    if((isset($_GET['dlt'])) && (!empty($_GET['dlt']))){
      $dlt_id = intval($_GET['dlt']);

      // Pobranie nazwy usuwanego użytkownika (dla tabeli postów)
      $query = "SELECT `users`.`username` FROM `users` WHERE `users`.`id` = {$dlt_id};";
      $result = mysqli_query($link,$query);
      $row = mysqli_fetch_assoc($result);
      $dlt_name = $row['username'];

      // Usuwanie użytkownika
      $query = "DELETE FROM `users` WHERE `users`.`id` = {$dlt_id} AND `users`.`username` = '$dlt_name'";
      if(mysqli_query($link,$query)){

        // Usuwanie komentarzy
        $query = "DELETE FROM `comments` WHERE `comments`.`author_id` = {$dlt_id};";
        mysqli_query($link,$query);

        // Usuwanie Postów
        $query = "DELETE FROM `posts` WHERE `posts`.`author` = '$dlt_name';";
        mysqli_query($link,$query);

        $user_status = "Usunięto użytkownika";

      }else{
        $user_status = "Nie ma takiego użytkownika";
      }
    }

    if((isset($_GET['ban'])) && (!empty($_GET['ban']))){
      $user_id = ($_GET['ban'] === '1') ? 'Błąd' : $_GET['ban'];
      $ban_date = date('Y-m-d');
      $ban_date = date('Y-m-d', strtotime($ban_date.' + 1 days'));
      $query = "UPDATE `users` SET `users`.`role` = 1, `users`.`ban_date` = '$ban_date' WHERE `users`.`id` = {$user_id};";
      if(mysqli_query($link,$query)){
        $query = "INSERT INTO notifications VALUES ({$user_id},1,NULL,0)";
        mysqli_query($link,$query);
        $user_status = "Zablokowano użytkownika na 1 dzień";
      }else{
        $user_status = "Nie ma takiego użytkownika";
      }
    }

    if((isset($_GET['reban'])) && (!empty($_GET['reban']))){
      $user_id = $_GET['reban'];
      $query = "UPDATE `users` SET `users`.`role` = 2, `users`.`ban_date` = '0000-00-00' WHERE `users`.`id` = {$user_id};";
      if(mysqli_query($link,$query)){
        $user_status = "Odblokowano Użytkownika";
        $query = "DELETE FROM notifications WHERE type = 1 AND receipient = {$user_id}";
        mysqli_query($link,$query);
        $query = "INSERT INTO notifications VALUES ({$user_id},4,NULL,0)";
        mysqli_query($link,$query);
      }else{
        $user_status = "Nie ma takiego użytkownika";
      }
    }
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
                <?php include 'includes/header.php'; create_header('Użytkownicy', ''); ?>
                <!-- /.Header -->

                <!-- Content -->
                <?php include "includes/sections/usersList_content.php"; ?>
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
    <script src="js/notifications.js"></script>

</body>

</html>
