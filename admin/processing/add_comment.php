<?php
  require '../../includes/db_conn.php';
  session_start();
  if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if((!empty($_POST['content'])) && (!empty($_POST['post_id']))){
      $author = $_SESSION['id'];
      $user = $_SESSION['username'];
      $content = mysqli_real_escape_string($link,$_POST['content']);
      $post_id = mysqli_real_escape_string($link,$_POST['post_id']);
      $date = mysqli_real_escape_string($link,date('Y-m-d'));
      if(isset($_POST['comment'])){
        $comment = $_POST['comment'];
        mysqli_query($link,"UPDATE `comments` SET `comments`.`response_count` = `comments`.`response_count` + 1 WHERE `comments`.`id` = {$comment}");
      }else{
        $comment = 0;
      }
      $query = "INSERT INTO `comments` VALUES (NULL, {$post_id}, {$author}, '$content', '$date', 0, {$comment})";
      if(mysqli_query($link,$query)){
        $query = "UPDATE `posts` SET `posts`.`comment_count` = `posts`.`comment_count` + 1 WHERE `posts`.`id` = {$post_id}";
        if(mysqli_query($link,$query)){
          echo '<!-- Nested Comment -->
          <div class="media">
              <a class="pull-left" href="#">
                  <img class="media-object comment_avatar" src="'.$_POST['img'].'" alt="">
              </a>
              <div class="media-body">
                  <h4 class="media-heading">'.$user.'
                      <small>'.$date.'</small>
                  </h4>
                  '.$content.'
            </div>
          </div>
          <!--/.Nested Comment -->';
          $not_link = '../post.php?id='.$post_id.'#posted_comments';
          $query = "INSERT INTO notifications VALUES ({$post_id},2,'$not_link',0)";
          mysqli_query($link,$query);
          if($comment != 0){
            $query = "SELECT author_id FROM comments WHERE id = {$comment}";
            $result = mysqli_query($link,$query);
            $row = mysqli_fetch_assoc($result);
            $response_id = $row['author_id'];
            $query = "INSERT INTO notifications VALUES ({$response_id},3,'$not_link',0)";
            mysqli_query($link,$query);
          }
        }else{
          echo "Wystąpił błąd ".mysqli_error($link);
        }
      }else{
        echo "Wystąpił błąd ".mysqli_error($link);
      }
    }else{
      echo "Chuj kurwa";
    }
  }
  session_abort();
  exit;

 ?>
