<!-- row -->
<div class="row">

  <!-- Blog Entries Column -->
  <div class="col-md-8">

      <?php include 'includes/header.php'; create_header('Tytuł', 'podtytuł'); ?>

      <article id="blog_posts">

      <?php
       $query = "SELECT * FROM posts";
       $result_posts = mysqli_query($link,$query);
       while ($row = mysqli_fetch_assoc($result_posts)) { ?>

        <!-- Blog Post -->
        <h2>
            <a href="post.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
        </h2>
        <p class="lead">
            by <a href="index.php"><?php echo $row['author']; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row['date']; ?></p>
        <hr>
        <img class="img-responsive post_thumbnail" src="img/uploads/<?php echo $row['img']; ?>" alt="">
        <hr>
        <p><?php if(strlen($row['content']) > 250){echo substr($row['content'],0,250)."...";}else{echo $row['content']."...";} ?></p>
        <a class="btn btn-primary" href="post.php?id=<?php echo $row['id']; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
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
