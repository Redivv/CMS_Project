<?php

  if(isset($_POST['search_btn'])){
    $search = $_POST['search'];
    $query = "SELECT * FROM posts WHERE tags LIKE '%$search%'";          // SELECT all FROM posts WHERE tags LIKE (are simmilar) to %search% (% means that there can be other values in this place but the result need to contain the other value)
    $search_results = mysqli_query($link,$query);
    if(!$search_results){
      die("ERROR" . mysqli_error($link));
    }
    $count = mysqli_num_rows($search_results);      // num_rows returns the number of selected rows
    if($count == 0){
      echo "<h1>No results Found</h1>";
    }
  }

 ?>
