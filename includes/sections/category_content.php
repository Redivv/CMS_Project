<!-- row -->
<div class="row">

  <!-- Blog Entries Column -->
  <div class="col-md-12">

      <?php include 'includes/header.php'; create_header($current_category, ''); ?>

      <article id="blog_posts">

      <?php
      if(isset($posts)){
       foreach($posts as $k => $v) { ?>

        <!-- Blog Post -->
        <h2>
            <a href="post.php?id=<?php echo $v['id']; ?>"><?php echo $v['title']; ?></a>
        </h2>
        <p class="lead">
            Autor <a href="index.php?author=<?php echo $v['author']; ?>"><?php echo $v['author']; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $v['date']; ?></p>
        <hr>
        <img class="img-responsive post_thumbnail" src="img/uploads/<?php echo $v['img']; ?>" alt="">
        <hr>
        <p><?php if(strlen($v['content']) > 250){echo substr($v['content'],0,250)."...";}else{echo $v['content']."...";} ?></p>
        <a class="btn btn-primary" href="post.php?id=<?php echo $v['id']; ?>">Czytaj Dalej <span class="glyphicon glyphicon-chevron-right"></span></a>
        <!-- /. Blog Post -->
    <?php
       }
     }else{
       echo $post_status;
     }
     ?>

    </article>

  </div>
  <!-- /.Blog Entries Column -->
</div>
<!-- /.row -->

<hr>    <!-- hr tag means that from this point there will be a diffrently styled part of site -->

<!-- Footer -->
<?php include "includes/footer.php"; ?>
<!-- /.Footer -->
