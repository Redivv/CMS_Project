<?php include 'includes/db_conn.php'; ?>
<?php

  $post_status = "";

  if((isset($_GET['dlt'])) && (!empty($_GET['dlt']))){
    $dlt_id = intval($_GET['dlt']);
    $query = "DELETE FROM `posts` WHERE `posts`.`id` = $dlt_id";

    if(mysqli_query($link,$query)){
      $post_status = "Usunięto post";
    }else{
      $post_status = "Nie ma takiego numeru posta";
    }
  }
 ?>
<!DOCTYPE html>
<html lang="en">

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
