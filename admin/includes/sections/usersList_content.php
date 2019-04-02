<div class="container-fluid">
  <div class="">
    <?php echo $user_status; ?>
  </div>
  <table class="table table-bordered table-hover">
    <thead>
      <th scope="col">Id</th>
      <th scope="col">Username</th>
      <th scope="col">Imię</th>
      <th scope="col">Nazwisko</th>
      <th scope="col">Mail</th>
      <th scope="col">Miniatura</th>
      <th scope="col">Rola</th>
      <th scope="col">Opcje</th>
    </thead>
    <tbody>
      <?php
      $query = "SELECT * FROM `users`";  // left joinuję tabelę z nazwami kategorii aby je wyświetlić
      if($result = mysqli_query($link,$query)){
        while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <th scope="row"><?php echo $row['id']; ?></th>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['last_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><img src="../img/uploads/<?php echo $row['thumbnail']; ?>" alt="" class="user_thumbnail img-responsive"></td>
            <td><?php echo $row['role']; ?></td>
            <td>
              <a class="btn-link" href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?dlt='.$row['id']; ?>">Usuń</a>
            </td>
          </tr>
    <?php }}else{echo "Błąd ".mysqli_error($link);} ?>
    </tbody>
  </table>
</div>
