<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
      <h4>Blog Search</h4>
      <form method="post">
        <div class="input-group">
            <input type="text" name="search" value="<?php if(isset($_POST['search_btn'])){echo $_POST['search'];} ?>" class="form-control">
            <span class="input-group-btn">
              <button name="search_btn" class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
              </button>
            </span>
        </div>
      </form>
    </div>
    <!-- /.Blog Search Well -->

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                  <?php
                   $query = "SELECT * FROM categories";
                   $result_categories = mysqli_query($link,$query);
                   while ($row = mysqli_fetch_assoc($result_categories)) {
                     $cat_title = $row['title'];

                     echo "<div class='col-lg-6'><li><a href='#'>$cat_title</a></li></div>";
                   }

                  ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- /.Blog Categories Well -->

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>
    <!-- /.Side Widget Well -->

</div>
<!-- /.row -->
