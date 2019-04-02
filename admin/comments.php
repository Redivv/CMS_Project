<?php include 'includes/db_conn.php'; ?>
<?php include 'processing/verification.php'; verification(1); ?>
<?php
  $comment_status = "";
  if($_SERVER['REQUEST_METHOD'] === "GET"){
    if((isset($_GET['del'])) && (!empty($_GET['del']))){
      $del = $_GET['del'];
      $query = "DELETE FROM `comments` WHERE `comments`.`id` = {$del}";
      if(mysqli_query($link,$query)){
        $comment_status = "Komentarz usunięto";
      }else{
        $comment_status = "Wystąpił Bład";
      }
    }elseif((isset($_GET['app'])) && (!empty($_GET['app']))){
      $app = $_GET['app'];
      $query = "UPDATE `comments` SET `comments`.`status` = 'zaakceptowany' WHERE `comments`.`id` = {$app}";
      if(mysqli_query($link,$query)){
        $comment_status = "Zaakceptowano";
      }else{
        $comment_status = "Wystąpił Błąd";
      }
    }elseif((isset($_GET['den'])) && (!empty($_GET['den']))){
      $den = $_GET['den'];
      $query = "UPDATE `comments` SET `comments`.`status` = 'odrzucony' WHERE `comments`.`id` = {$den}";
      if(mysqli_query($link,$query)){
        $comment_status = "Odrzucono";
      }else{
        $comment_status = "Wystąpił Błąd";
      }
    }
  }
  $query = "SELECT `comments`.*, `posts`.`id` AS `post_id`, `posts`.`title` AS `post_title` FROM `comments` LEFT JOIN `posts` ON `comments`.`post_id` = `posts`.`id`";
  if($result = mysqli_query($link,$query)){
    $comments = array();
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
      foreach ($row as $k => $v) {
        $comments[$i][$k] = $v;
      }
      $i++;
    }
  }else{
    $comment_status = "Wystąpił Bład";
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
                <?php include 'includes/header.php'; create_header('Komentarze', 'podtytuł'); ?>
                <!-- /.Header -->

                <!-- Content -->
                <?php include "includes/sections/comments_content.php"; ?>
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

</body>

</html>
