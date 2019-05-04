<div id="posted_comments">
  <div id="new_comment"></div>
  <?php
  $query = "SELECT `comments`.*, `users`.`username`,`users`.`thumbnail` FROM `comments` LEFT JOIN `users` ON `comments`.`author_id` = `users`.`id` WHERE `comments`.`post_id` = $post_id AND `comments`.`response_id` = 0 ORDER BY `comments`.`id` DESC";
  if($result = mysqli_query($link,$query)){
    while ($row = mysqli_fetch_assoc($result)) { ?>
      <!-- Comment -->
      <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object comment_avatar" src="img/uploads/<?php echo $row['thumbnail']; ?>" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading"><?php echo $row['username']; ?>
                <small><?php echo $row['date']; ?></small>
            </h4>
            <p><?php echo $row['content']; ?></p>
            <div>
              <small>
                <span data-comment="<?php echo $row['id']; ?>" class="btn response">odpowiedz</span>
                <?php if($row['username'] === $_SESSION['username']){ ?>
                <span data-comment = <?php echo $row['id']; ?> class="btn edit">edytuj</span>
                <span data-comment = <?php echo $row['id']; ?> class="btn delete">usuń</span>
                <?php } ?>
              </small>
            </div>
            <?php
            if($row['response_count'] > 0){
              $query = "SELECT `comments`.*, `users`.`username`,`users`.`thumbnail` FROM `comments` LEFT JOIN `users` ON `comments`.`author_id` = `users`.`id` WHERE `comments`.`response_id` = {$row['id']} ORDER BY `comments`.`id` DESC";
              if($result2 = mysqli_query($link,$query)){
                while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                    <!-- Nested Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object comment_avatar" src="img/uploads/<?php echo $row2['thumbnail']; ?>" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $row2['username']; ?>
                                <small><?php echo $row2['date']; ?></small>
                            </h4>
                          <p><?php echo $row2['content']; ?></p>
                          <?php if($row2['username'] === $_SESSION['username']){ ?>
                          <div>
                            <small>
                              <span data-comment = <?php echo $row2['id']; ?> class="btn edit">edytuj</span>
                              <span data-comment = <?php echo $row2['id']; ?> class="btn delete">usuń</span>
                            </small>
                          </div>
                          <?php } ?>
                        </div>
                    </div>
                    <!--/.Nested Comment -->
          <?php  }}} ?>
        </div>
      </div>
      <!--/.Comment -->

    <?php  }
    }else{
      echo "Wystąpił bład ".mysqli_error($link);
      exit;
    }
   ?>
</div>
