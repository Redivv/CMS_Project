<?php require '../includes/db_conn.php'; ?>
<?php
   if((isset($_POST['new_title'])) && !empty($_POST['new_title'])){
   $new_title = htmlspecialchars(mysqli_real_escape_string($link,$_POST['new_title']));
   $id = intval($_POST['id']);

   $query = "UPDATE `categories` SET `title` = '$new_title' WHERE `categories`.`id` = {$id}";

   if(mysqli_query($link,$query)){
     echo 'Zapisano dane';
     exit;
   }else{
     echo "Wystąpił błąd ".mysqli_error($link);
     exit;
   }
 }
 ?>
