<!-- row -->
<div class="row">

  <!-- Blog Entries Column -->
  <div class="col-md-8 post_container">

      <?php include 'includes/header.php'; if(isset($_GET['author'])){create_header('Posty Użytkownika',$_GET['author']);}else{create_header('Witaj na Moim Blogu!', '');} ?>

      <article id="blog_posts">

      <?php
       if(isset($_GET['author'])){
        $author = $_GET['author'];
        $query = "SELECT * FROM posts WHERE status = 'Publiczny' AND author = '$author'";
       }else{
        $query = "SELECT * FROM posts WHERE status = 'Publiczny'";
       }
       $result_posts = mysqli_query($link,$query);
       while ($row = mysqli_fetch_assoc($result_posts)) { ?>

        <!-- Blog Post -->
        <h2>
            <a href="post.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
        </h2>
        <p class="lead">
            Autor <a href="index.php?author=<?php echo $row['author']; ?>"><?php echo $row['author']; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Napisany <?php echo $row['date']; ?></p>
        <hr>
        <a href="post.php?id=<?php echo $row['id']; ?>"><img class="img-responsive post_thumbnail" src="img/uploads/<?php echo $row['img']; ?>" alt=""></a>
        <hr>
        <p><?php if(strlen($row['content']) > 250){echo substr($row['content'],0,250)."...";}else{echo $row['content']."...";} ?></p>
        <a class="btn btn-primary" href="post.php?id=<?php echo $row['id']; ?>">Czytaj Dalej <span class="glyphicon glyphicon-chevron-right"></span></a>
        <div><h5>Tagi: <?php echo $row['tags']; ?></h5></div>
        <!-- /. Blog Post -->
    <?php } ?>

    </article>

  </div>
  <!-- /.Blog Entries Column -->

  <hr class="hide-desktop">

  <!-- Blog Sidebar Widgets Column -->
  <?php include "includes/sidebar.php" ?>
  <!-- /.Blog Sidebar Widgets Column -->
</div>
<!-- /.row -->

<hr>    <!-- hr tag means that from this point there will be a diffrently styled part of site -->

<!-- Footer -->
<?php include "includes/footer.php"; ?>
<!-- /.Footer -->
