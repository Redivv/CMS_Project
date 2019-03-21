<?php
  include 'db_conn.php';

    $search = mysqli_real_escape_string($link,$_REQUEST['wanted']);
    if(!empty($search)){
      $query = "SELECT * FROM posts WHERE tags LIKE '%$search%'";
    }
    else{
      $query = "SELECT * FROM posts";
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
            <a href="#">'.$row['title'].'</a>
        </h2>
        <p class="lead">
            by <a href="index.php">'.$row['author'].'</a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on '.$row['date'].'</p>
        <hr>
        <img class="img-responsive post_thumbnail" src="img/'.$row['img'].'" alt="">
        <hr>
        <p>';
        if(strlen($row['content']) > 250){$results.=substr($row['content'],0,250)."...";}else{$results .=$row['content']."...";}
        $results.='</p>
        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        <!-- /. Blog Post -->';
      }
      echo $results;
      die();
 ?>
