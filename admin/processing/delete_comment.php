<?php
  require '../../includes/db_conn.php';
  session_start();
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if((!empty($_POST['comment_id'])) && (!empty($_POST['post_id']))){
      $comment_id = $_POST['comment_id'];
      $user_id = $_SESSION['id'];
      $post_id = $_POST['post_id'];
      $query = "DELETE FROM `comments` WHERE (`comments`.`id` = {$comment_id} OR `comments`.`response_id` = {$comment_id}) AND (`comments`.`author_id` = {$user_id} AND `comments`.`post_id` = {$post_id});";
      if(mysqli_query($link,$query)){
        $deleted = mysqli_affected_rows($link);
        mysqli_query($link,"UPDATE `posts` SET `posts`.`comment_count` = `posts`.`comment_count` - {$deleted} WHERE `posts`.`id` = {$post_id}");
        echo "Usunięto komentarz";
      }else{
        echo "Wystąpił Bład";
      }
    }else{
      echo "Wystąpił Bład";
    }
  }
  session_abort();
  exit;
 ?>
