<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
      <h4>Wyszukiwanie po Tagach</h4>
      <form method="post">
        <div class="input-group">
            <input type="text" name="search" value="" class="form-control">
            <span class="input-group-btn">
              <button name="search_btn" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
              </button>
            </span>
        </div>
      </form>
    </div>
    <!-- /.Blog Search Well -->

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Wszystkie Kategorie</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                  <?php
                   $query = "SELECT * FROM categories";
                   $result_categories = mysqli_query($link,$query);
                   while ($row = mysqli_fetch_assoc($result_categories)) {
                     $cat_title = $row['title'];
                     $cat_id = $row['id'];

                     echo "<div class='col-lg-6'><li><a href='category.php?category=$cat_id'>$cat_title</a></li></div>";
                   }

                  ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- /.Blog Categories Well -->

</div>
<!-- /.row -->
