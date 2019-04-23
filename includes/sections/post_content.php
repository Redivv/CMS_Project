<div class="row">

    <!-- Blog Post Content Column -->
    <div class="col-lg-12">

        <!-- Blog Post -->

        <!-- Title -->
        <h1><?php echo $title; ?></h1>

        <!-- Author -->
        <p class="lead">
            by <a href="#"><?php echo $author; ?></a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>

        <hr>

        <!-- Preview Image -->
        <img class="img-responsive" src="<?php echo $img; ?>" alt="">

        <hr>

        <!-- Post Content -->
        <p class="lead"><?php echo $content; ?>

        <hr>

        <!-- Blog Comments -->

        <!-- Comments Form -->
        <?php
        if(isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"] == true) && ($_SESSION['role'] >= 2)){  ?>
        <div class="well">
            <h4>Dodaj komentarz</h4>
            <form role="form">
              <div class="form-group">
                <textarea id="comment_content" data-post="<?php echo $post_id; ?>" data-author="<?php echo $_SESSION['id']; ?>" class="form-control" name="comment" rows="3"></textarea>
              </div>
              <button name="comment_btn" type="submit" class="btn btn-primary" disabled>Submit</button>
            </form>
            <div id="comment_error_block"></div>
        </div>
       <?php
       }else{ ?>
       <div class="well">
           <h4><?php echo (isset($_SESSION['role'])) ? 'Zostałeś Zablokowany' : 'Zaloguj Się aby zostawić komentarz'; ?></h4>
           <form role="form">
             <div class="form-group">
               <textarea class="form-control" name="name" rows="3" disabled></textarea>
             </div>
             <button type="submit" class="btn btn-primary" disabled>Submit</button>
           </form>
           <div id="comment_error_block"></div>
       </div>
     <?php } ?>
     <!-- /.Comments Form -->

        <hr>

      <!-- Posted Comments -->
      <?php
        if(!isset($_SESSION["loggedin"]) || ($_SESSION["loggedin"] !== true) || ($_SESSION['role'] <= 1)){      // jeśli przypadkiem użytkownik jest już zalogowany na sesji to przenosi go na stronę główną
          include 'includes/comments_guest.php';
        }else{
          include "includes/comments.php";
        }
       ?>
      <!-- /.Posted Comments -->

  </div>
</div>
  <!-- /.row -->

  <hr>

  <!-- Footer -->
  <?php include 'includes/footer.php'; ?>
  <!-- /.Footer -->
