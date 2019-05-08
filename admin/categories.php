<?php include 'includes/db_conn.php'; ?>
<?php include 'processing/verification.php'; verification(3); ?>
<?php

  $cat_title = $cat_title_err  = "";

  // Insert Category
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!empty($_POST['cat_title'])){
      $cat_title = mysqli_real_escape_string($link,$_POST['cat_title']);
      $query = "INSERT INTO `categories` (`id`, `title`) VALUES ( NULL, '$cat_title')";
      if(mysqli_query($link,$query)){
        $cat_title_err = "Dane zostały zapisane";
      }else{
        $cat_title_err = "Wystąpił błąd".mysqli_error($link);  // error zwraca tekstowy błąd z ostatniej operacji, errno zwraca numer błędu
      }
    }else{
      $cat_title_err = "Wpisz nazwę Kategorii";
    }
  }
  // /.Insert Category

  // Delete Category
  if((isset($_GET['dlt'])) && !empty($_GET['dlt'])){
    $cat_id = $_GET['dlt'];
    $query = "DELETE FROM `categories` WHERE `categories`.`id` = {$cat_id}";
    if(mysqli_query($link,$query)){
      header('location: categories.php');
    }else{
      echo "Wystąpił bład ".mysqli_error($link);
    }
  }
  // /.Delete Category
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
                <?php include 'includes/header.php'; create_header('Kategorie', 'Jakiś podtytuł'); ?>
                <!-- /.Header -->

                <!-- Content -->
                <?php include "includes/sections/categories_content.php"; ?>
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
