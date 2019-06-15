<?php include 'includes/db_conn.php'; ?>
<?php include 'processing/verification.php'; verification(2); ?>
<?php

  $post_status = "";

  if((isset($_GET['dlt'])) && (!empty($_GET['dlt']))){
    $dlt_id = intval($_GET['dlt']);

    // Pobieranie nazwy miniaturki usuwanego posta
    $query = "SELECT `posts`.`img` FROM `posts` WHERE `posts`.`id` = {$dlt_id};";
    $result = mysqli_query($link,$query);
    $row = mysqli_fetch_assoc($result);
    $dlt_img = $row['img'];

    // Usuwanie Posta
    $query = "DELETE FROM `posts` WHERE `posts`.`id` = {$dlt_id}";
    if(mysqli_query($link,$query)){
      if (($dlt_img != "post_normal_thumb.jpg") && (mysqli_affected_rows($link) === 1) ) {
        unlink('../img/uploads/'.$dlt_img);
      }
      $post_status = "Usunięto post";
    }else{
      $post_status = "Nie ma takiego numeru posta";
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
                <?php include 'includes/header.php'; create_header('Posty', ''); ?>
                <!-- /.Header -->

                <!-- Content -->
                <?php include "includes/sections/posts_content.php"; ?>
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
