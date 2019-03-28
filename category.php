<?php include "includes/db_conn.php"; ?>
<?php
  if($_SERVER['REQUEST_METHOD'] == "GET"){
    if((isset($_GET['category'])) && (!empty($_GET['category']))){
      $category_id = $_GET['category'];
      $query = "SELECT `categories`.`title` FROM `categories` WHERE `categories`.`id` = '$category_id'";
      if($result = mysqli_fetch_all(mysqli_query($link, $query))){
        $current_category = $result[0][0];
      }
      $query = "SELECT * FROM `posts` WHERE `posts`.`category_id` = $category_id";
      if($result = mysqli_fetch_all(mysqli_query($link,$query))){
        foreach($result as $k => $v){
          $posts[$k]['id'] = $v[0];
          $posts[$k]['cat_id'] = $v[1];
          $posts[$k]['title'] = $v[2];
          $posts[$k]['author'] = $v[3];
          $posts[$k]['date'] = $v[4];
          $posts[$k]['img'] = $v[5];
          $posts[$k]['content'] = $v[6];
        }
      }else{
        $post_status = "Brak postów w tej kategorii";
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
      if(isset($post_status)){
        if((!empty($post_status)) && ($post_status == "Wystąpił Błąd")){
          echo $post_status;
        }else{
          include 'includes/sections/category_content.php';
        }
      }else{
        include 'includes/sections/category_content.php';
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
