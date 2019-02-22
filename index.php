<?php include "includes/db_conn.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <?php include "includes/nav.php" ?>
    <!-- /.Navigation -->

    <!-- Page Content -->
    <div class="container">
        <!-- row -->
        <div class="row">

          <!-- Blog Entries Column -->
          <div class="col-md-8">

              <?php include 'includes/header.php'; ?>

              <article id="blog_posts">

              <?php
               $query = "SELECT * FROM posts";
               $result_posts = mysqli_query($link,$query);
               while ($row = mysqli_fetch_assoc($result_posts)) { ?>

                <!-- Blog Post -->
                <h2>
                    <a href="#"><?php echo $row['title']; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $row['author']; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row['date']; ?></p>
                <hr>
                <img class="img-responsive post_thumbnail" src="img/<?php echo $row['img']; ?>" alt="">
                <hr>
                <p><?php if(strlen($row['content']) > 250){echo substr($row['content'],0,250)."...";}else{echo $row['content']."...";} ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <!-- /. Blog Post -->
            <?php } ?>

            </article>

          </div>
          <!-- /.Blog Entries Column -->

          <!-- Blog Sidebar Widgets Column -->
          <?php include "includes/sidebar.php" ?>
          <!-- /.Blog Sidebar Widgets Column -->
        </div>
        <!-- /.row -->

        <hr>    <!-- hr tag means that from this point there will be a diffrently styled part of site -->

        <!-- Footer -->
        <?php include "includes/footer.php"; ?>
        <!-- /.Footer -->

  </div>
  <!-- /.Page Content -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- My script  -->
    <script src="js/main.js"></script>

</body>

</html>
