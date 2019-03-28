<div class="container-fluid">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
    <div class="<?php if(!empty($post_status)){echo ($post_status == 'Wystąpił błąd') ? 'error-block' : 'sent';} ?>">
      <?php echo $post_status; ?>
    </div>
    <div class="form-group">
      <label for="title">Tytuł</label>
      <input id="title" type="text" name="title" value="<?php echo $title; ?>" class="form-control">
      <div class="error-block"><?php echo $title_err; ?></div>
    </div>

    <!-- Do poprawienia po dodaniu systemu logowania -->
    <div class="form-group">
      <label for="author">Autor</label>
      <select id="author" name="author" class="form-control">
        <option value="autor">Autor</option>
      </select>
    </div>
    <!-- Do poprawienia po dodaniu systemu logowania -->

    <div class="form-group">
      <label for="category">Kategoria</label>
      <select id="category" class="form-control" name="category">
        <?php foreach ($categories as $key => $value) { ?>
                <option value="<?php echo $value['id']; ?>" <?php if($value['id'] ==  $category){echo "selected";} ?>><?php echo $value['title']; ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label for="status">Status</label>
      <select id="status" class="form-control" name="status">
        <option value="status">Status</option>
      </select>
    </div>
    <div class="form-group">
      <label for="thumbnail">
        Miniatura
        <div class="thumbnail-box" style="color:red">
          <img src="<?php echo $img; ?>" alt="">
        </div>
      </label>
      <input id="thumbnail" name="thumbnail" type="file">
    </div>
    <div class="form-group">
      <label for="tags">Tagi</label>
      <input id="tags" name="tags" type="text" value="<?php echo $tags; ?>" class="form-control">
    </div>
    <div class="form-group">
      <label for="content">Treść</label>
      <textarea id="<content></content>" class="form-control"  name="content" rows="8"><?php echo $content; ?></textarea>
    </div>
    <button class="btn btn-block btn-primary" type="submit" name="post_id" value="<?php echo $post_id; ?>">Dodaj</button>
  </form>
</div>
