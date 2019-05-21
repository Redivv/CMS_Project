<!-- Powiadomienia -->
  <div class="notifications well">
    Kiedyś tu będą Powiadomienia ale jeszcze nie mam pomysłu
  </div>
<!-- /.Powiadomienia -->

<?php

  $author = $_SESSION['username'];
  $user_id = $_SESSION['id'];
  $role = $_SESSION['role'];

  // Get posts viewed count (get all posts on Admin)
  if ($role === 3) {
    $query = "SELECT id FROM posts;";
    $viewed_count = mysqli_num_rows(mysqli_query($link,$query));
  }else{
    $query = "SELECT viewed_count FROM posts WHERE author = '$author'";
    $result = mysqli_query($link,$query);
    $numbers = mysqli_fetch_all($result);
    $viewed_count = 0;
    foreach ($numbers as $k => $v) {
      $viewed_count += $v[0];
    }
  }

  // Get Comments on logged in user posts (all comments on Admin)
  if ($role === 3) {
    $query = "SELECT id FROM comments;";
  }else{
    $query = "SELECT `users`.`username`, `posts`.`id`, `comments`.`id` FROM `users` INNER JOIN `posts` ON `posts`.`author` = `users`.`username` INNER JOIN `comments` ON `comments`.`post_id` = `posts`.`id` WHERE ";
    $query .= "`users`.`id` = {$user_id};";
  }
  $comments_count = mysqli_num_rows(mysqli_query($link,$query));

  // Get * on logged in user (all users on admin)
  if ($role === 3) {
    $query = "SELECT id FROM users;";
    $users_count = mysqli_num_rows(mysqli_query($link,$query));
  }

  // Get Posts from all categories for Google Chart and all categories for Admin
  $query = "SELECT title FROM categories";
  $result = mysqli_query($link,$query);
  $cat_count = mysqli_num_rows($result);
  $cat_post = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $cat_post[$row['title']] = 0;
  }
  if ($role === 3) {
    $query = "SELECT `categories`.`title`, `posts`.`id` FROM `categories` INNER JOIN `posts` ON `posts`.`category_id` = `categories`.`id`;";
  }else{
    $query = "SELECT `categories`.`title`, `posts`.`id` FROM `categories` INNER JOIN `posts` ON `posts`.`category_id` = `categories`.`id` WHERE `posts`.`author` = '$author'";
  }
  $result = mysqli_query($link,$query);
  while ($row = mysqli_fetch_assoc($result)) {
    $cat_post[$row['title']] += 1;
  }
?>

<!-- Widgety -->
  <div class="widgets row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                  <div class='huge'><?php echo $viewed_count ?></div>
                        <div><?php echo ($role === 3) ? 'Posty' : 'Wyświetlenia'; ?></div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">Zobacz Szczegóły</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     <div class='huge'><?php echo $comments_count; ?></div>
                      <div><?php echo ($role === 3) ? 'Komentarze' : 'Komentarze Pod Postami'; ?></div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">Zobacz Szczegóły</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <div class='huge'><?php echo $users_count-1; ?></div>
                        <div><?php echo ($role === 3) ? 'Użytkownicy' : 'Nie wiem gurwa'; ?></div>
                    </div>
                </div>
            </div>
            <a href="users_list.php">
                <div class="panel-footer">
                    <span class="pull-left">Zobacz Szczegóły</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo $cat_count; ?></div>
                         <div><?php echo ($role === 3) ? 'Kategorie' : 'Nie wiem gurwa'; ?></div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">Zobacz Szczegóły</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.Widgety -->

<!-- Chart -->
  <div id="chart_div"></div>
<!-- /.Chart -->
