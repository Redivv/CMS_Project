<?php
  require '../../includes/db_conn.php';
  session_start();
  if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if((!empty($_POST['content'])) && (!empty($_POST['post_id']))){
      $author = $_SESSION['id'];
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
                  <h4 class="media-heading">Jakob2
                      <small>'.$date.'</small>
                  </h4>
                  '.$content.'
            </div>
          </div>
          <!--/.Nested Comment -->';
          $type = ($comment === 0) ? 2 : 3;
          $not_link = '../post.php?id='.$post_id;
          $receipients = array('First' => $post_id, 'Second' => $comment);
          $receipients = mysqli_real_escape_string($link,serialize($receipients));
          $query = "INSERT INTO notifications VALUES (NULL,{$type},'$not_link','$receipients')";
          mysqli_query($link,$query);
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
