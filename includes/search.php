<?php
  include 'db_conn.php';

    $search = htmlspecialchars(mysqli_real_escape_string($link,$_REQUEST['wanted']));
    if(!empty($search)){
      $query = "SELECT * FROM posts WHERE tags LIKE '%$search%' AND status = 'Publiczny'";
    }
    else{
      $query = "SELECT * FROM posts WHERE status = 'Publiczny'";
    }
    $search_results = mysqli_query($link,$query);
      if(!$search_results){
        die("ERROR" . mysqli_error($link));
      }
      $count = mysqli_num_rows($search_results);      // num_rows returns the number of selected rows
      if($count == 0){
        echo "<h1>Nie znaleziono wyników</h1>";
        die();
      }
      $results = "";
      while ($row = mysqli_fetch_assoc($search_results)) {
        $results.='<!-- Blog Post -->
        <h2>
            <a href="post.php?id='.$row['id'].'">'.$row['title'].'</a>
        </h2>
        <p class="lead">
            Autor <a href="index.php?author='.$row['author'].'">'.$row['author'].'</a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Napisany '.$row['date'].'</p>
        <hr>
        <img class="img-responsive post_thumbnail" src="img/uploads/'.$row['img'].'" alt="">
        <hr>
        <p>';
        if(strlen($row['content']) > 250){$results.=substr($row['content'],0,250)."...";}else{$results .=$row['content']."...";}
        $results.='</p>
        <a class="btn btn-primary" href="post.php?id='.$row['id'].'">Czytaj Dalej <span class="glyphicon glyphicon-chevron-right"></span></a>
        <!-- /. Blog Post -->';
      }
      echo $results;
      die();
 ?>
