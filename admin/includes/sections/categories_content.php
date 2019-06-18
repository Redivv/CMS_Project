<div class="row">
  <div class="col-xs-6">

    <!-- Category Form -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-group">
        <label for="cat_title">Tytuł Kategorii</label>
        <input class="form-control" value="<?php echo $cat_title; ?>" name="cat_title" type="text">
        <div class="error-block <?php echo ($cat_title_err === "Dane zostały zapisane") ? 'sent' : '' ?>"><?php echo $cat_title_err; ?></div>
      </div>
      <div class="form-group">
        <button class="btn btn-primary" type="submit">Dodaj Nową Kategorię</button>
      </div>
    </form>
    <!-- /.Category Form -->

  </div>
  <div class="col-xs-6">

    <!-- Categories Table -->
    <table class="table table-responsive table-bordered table-hover">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Tytuł Kategorii</th>
          <th scope="col">Opcje</th>
        </tr>
      </thead>
      <tbody>

        <!-- Display data from categories -->
        <?php
         $query = "SELECT * FROM categories";
         $result_categories = mysqli_query($link,$query);
         while ($row = mysqli_fetch_assoc($result_categories)) {
           $cat_id = $row['id'];
           $cat_title = $row['title']; ?>

           <tr>
             <th scope="row"><?php echo $cat_id; ?></th>
             <td><?php echo $cat_title; ?></td>
             <td>
               <a class="btn-link delete" href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?dlt='.$cat_id; ?>">Usuń</a>
               <button class="edit-btn btn-link" data-id="<?php echo $cat_id; ?>" data-title = "<?php echo $cat_title; ?>">Edytuj</button>
             </td>
           </tr>

        <?php  } ?>
        <!-- /.Display data from categories -->

      </tbody>
    </table>
    <!-- /.Categories Table -->

  </div>
</div>
