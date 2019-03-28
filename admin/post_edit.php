<?php include 'includes/db_conn.php'; ?>
<?php

  $query = "SELECT * FROM `categories`";
  if($result = mysqli_query($link, $query)){
    foreach (mysqli_fetch_all($result) as $key => $value) {
      $categories[$key]['id'] = $value[0];
      $categories[$key]['title'] = $value[1];
    }
  }
  $post_id = $category = $title = $img = $tags = $content = "";

  if($_SERVER['REQUEST_METHOD'] == "GET"){
    if((isset($_GET['id'])) && (!empty($_GET['id']))){
      $post_id = $_GET['id'];
      $query = "SELECT `posts`.* , `categories`.`title` AS `category` FROM `posts` LEFT JOIN `categories` ON `posts`.`category_id` = `categories`.`id` WHERE `posts`.`id` = $post_id";
      if($result = mysqli_fetch_assoc(mysqli_query($link,$query))){
        $title = $result['title'];
        $img = '../img/uploads/'.$result['img'];
        $tags = $result['tags'];
        $content = $result['content'];
        $category = $result['category_id'];
      }else{
        $post_status = "Taki post nie istnieje";
      }
    }
  }

  $title_err = $post_status =  "";
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['title'])) {
      $post_id = (!empty($_POST['post_id'])) ? $_POST['post_id'] : '';
      $new_post = array();
      $new_post[0] = $_POST['title'];
      $new_post[1] = (!empty($_POST['author'])) ? mysqli_real_escape_string($link,$_POST['author']) : 'autor'; // powiniene dodać aktualnie zalogowanego użytkownika ale to potem
      $new_post[2] = (!empty($_POST['category'])) ? intval(mysqli_real_escape_string($link,$_POST['category'])) : 'kategoria';
      $new_post[3] = (!empty($_POST['status'])) ? mysqli_real_escape_string($link,$_POST['status']) : 'status';
      $new_post[4] = ($_FILES['thumbnail']['size'] > 0) ? mysqli_real_escape_string($link,upload_image($_FILES['thumbnail'])) : '';
      $new_post[5] = (!empty($_POST['tags'])) ? mysqli_real_escape_string($link,$_POST['tags']) : 'tagi';
      $new_post[6] = (!empty($_POST['content'])) ? mysqli_real_escape_string($link,$_POST['content']) : 'treść';
      $new_post[7] = date('Y-m-d');

      if(!empty($post_id)){
        $query = "UPDATE `posts` SET `category_id` = $new_post[2], `title` = '$new_post[0]', `author` = '$new_post[1]', ";
        if(!empty($new_post[4])){$query .= "`img` = '$new_post[4]', ";}
        $query .= "`content` = '$new_post[6]', `tags` = '$new_post[5]', `status` = '$new_post[3]' WHERE `posts`.`id` = $post_id;";
      }else{
        $query = "INSERT INTO `posts` VALUES (NULL, $new_post[2], '$new_post[0]', '$new_post[1]', '$new_post[7]', '$new_post[4]', '$new_post[6]', '$new_post[5]', 0, '$new_post[3]')";
      }
      if(mysqli_query($link, $query)){
        $post_status = "Dane zapisano";
      }else{
        $post_status = "Wystąpił błąd";
      }
    }else{
      $title_err = "Wprowadź Tytuł";
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
                <?php include "includes/sections/postEdit_content.php"; ?>
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
