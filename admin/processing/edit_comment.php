<?php
  require '../../includes/db_conn.php';
  session_start();
  if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if((!empty($_POST['content'])) && (!empty($_POST['comment_id'])) && (!empty($_POST['post_id']))){
      $comment_id = mysqli_real_escape_string($link,$_POST['comment_id']);
      $content = mysqli_real_escape_string($link,$_POST['content']);
      $post_id = $_POST['post_id'];
      $query = "UPDATE `comments` SET `content` = '$content' WHERE `comments`.`id` = {$comment_id} AND (`comments`.`author_id` = {$_SESSION['id']} AND `comments`.`post_id` = {$post_id});";
      if(mysqli_query($link,$query)){
        echo $content;
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
