<div class="container-fluid">
  <div class="<?php if(!empty($post_status)){echo ($post_status == 'Nie ma takiego numeru posta') ? 'error-block' : 'sent';} ?>">
    <?php echo $post_status; ?>
  </div>
  <table class="table table-bordered table-hover">
    <thead>
      <th scope="col">Id</th>
      <th scope="col">Autor</th>
      <th scope="col">Tytuł</th>
      <th scope="col">Kategoria</th>
      <th scope="col">Status</th>
      <th scope="col">Miniatura</th>
      <th scope="col">Tagi</th>
      <th scope="col">Komentarze</th>
      <th scope="col">Data</th>
      <th scope="col">Liczba Wyświetleń</th>
      <th scope="col">Opcje</th>
    </thead>
    <tbody>
      <?php
      if ($_SESSION['role'] === 3) {
        $query = "SELECT `posts`.* , `categories`.`title` AS `category` FROM `posts` LEFT JOIN `categories` ON `posts`.`category_id` = `categories`.`id`";  // left joinuję tabelę z nazwami kategorii aby je wyświetlić
      }else{
        $query = "SELECT `posts`.* , `categories`.`title` AS `category` FROM `posts` LEFT JOIN `categories` ON `posts`.`category_id` = `categories`.`id` WHERE `posts`.`author` = '$_SESSION[username]'";  // left joinuję tabelę z nazwami kategorii aby je wyświetlić
      }
      if($result_posts = mysqli_query($link,$query)){
        while ($row = mysqli_fetch_assoc($result_posts)) { ?>
          <tr>
            <th scope="row"><?php echo $row['id']; ?></th>
            <td><?php echo $row['author']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><img src="../img/uploads/<?php echo $row['img']; ?>" alt="" class="post_thumbnail img-responsive"></td>
            <td><?php echo $row['tags']; ?></td>
            <td><?php echo $row['comment_count']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['viewed_count']; ?></td>
            <td>
              <a href = "post_edit.php?id=<?php echo $row['id']; ?>" class="btn-link">Edytuj</a>
              <a class="btn-link delete" href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?dlt='.$row['id']; ?>">Usuń</a>
            </td>
          </tr>
    <?php }}else{echo "Błąd ".mysqli_error($link);} ?>
    </tbody>
  </table>
</div>
