<div class="container-fluid">
  <div class="<?php echo ($comment_status === "Wystąpił Błąd") ? 'error-block' : 'sent'; ?>"><?php echo $comment_status; ?></div>
  <table class="table table-bordered table-hover">
    <thead>
      <th scope="col">Id</th>
      <th scope="col">Tytuł Posta</th>
      <th scope="col">Autor</th>
      <th scope="col">Treść</th>
      <th scope="col">Data</th>
      <th scope="col">Opcje</th>
    </thead>
    <tbody>
      <?php
        foreach ($comments as $k => $v) { ?>
          <tr>
            <th span="row"><?php echo $v['id']; ?></th>
            <td><?php echo $v['post_title']; ?></td>
            <td><?php echo $v['username']; ?></td>
            <td><?php echo $v['content']; ?></td>
            <td><?php echo $v['date']; ?></td>
            <td>
              <a class="btn-link delete" href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?del=".$v['id'];?>">Usuń</a>
            </td>
          </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
