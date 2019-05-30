<?php include 'includes/db_conn.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['id']) && isset($_GET['hash'])) {
    $id = $_GET['id'];
    $hash = $_GET['hash'];
    $query = "UPDATE users SET email=(@temp:=email), email = last_email, last_email = @temp, hash = null WHERE id = {$id} AND hash = '$hash';";
    if (mysqli_query($link,$query)) {
      if (mysqli_affected_rows($link) === 1) {
        header('location:profile.php');
      }else{
        echo "Wystąpił Bład";
        die;
      }
    }else{
      echo "Wystąpiłł Bład";
      die;
    }
  }
}else{
  echo "Wystąpił Bład";
}
?>
