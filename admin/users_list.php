<?php include 'includes/db_conn.php'; ?>
<?php include 'processing/verification.php'; verification(3); ?>
<?php

  $user_status = "";

  if((isset($_GET['dlt'])) && (!empty($_GET['dlt']))){
    $dlt_id = intval($_GET['dlt']);
    $query = "DELETE FROM `users` WHERE `users`.`id` = $dlt_id";

    if(mysqli_query($link,$query)){
      $post_status = "Usunięto użytkownika";
    }else{
      $post_status = "Nie ma takiego użytkownika";
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

        <!-- Footer -->
        <?php include "includes/footer.php"; ?>
        <!-- /.Footer -->
    </div>
    <!-- /.wrapper -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js">

    </script>

</body>

</html>
