<?php include "includes/db_conn.php"; ?>
<?php
  if($_SERVER['REQUEST_METHOD'] == "GET"){
    if((isset($_GET['id'])) && (!empty($_GET['id']))){
      $post_id = $_GET['id'];
      $query = "SELECT `posts`.* , `categories`.`title` AS `category` FROM `posts` LEFT JOIN `categories` ON `posts`.`category_id` = `categories`.`id` WHERE `posts`.`id` = $post_id";
      if($result = mysqli_fetch_assoc(mysqli_query($link,$query))){
        $title = $result['title'];
        $author = $result['author'];
        $date = $result['date'];
        $img = 'img/uploads/'.$result['img'];
        $content = $result['content'];
      }else{
        $post_status = "Taki post nie istnieje";
      }
    }else{
      $post_status = "Wystąpił błąd";
    }
  }else{
    $post_status = "Wystąpił bład";
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "includes/header_html.php"; ?>
</head>

<body>

  <!-- Navigation -->
  <?php include "includes/nav.php" ?>
  <!-- /.Navigation -->

    <!-- Page Content -->
    <div class="container">
      <?php
      if(empty($post_status)){
        include 'includes/sections/post_content.php';
      }else{
        echo $post_status;
      }
      ?>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
