<div class="container-fluid">
  <ul class="nav nav-pills nav-justified" role="tablist">
    <li role="presentation" class="active"><a href="#idInfo" role="tab" data-toggle="tab">Identyfikator Użytkownika</a></li>
    <li role="presentation"><a href="#loginInfo" role="tab" data-toggle="tab">Dane Logowania</a></li>
    <li role="presentation"><a href="#addInfo" role="tab" data-toggle="tab">Informacje Szczegółowe</a></li>
    <li role="presentation"><a href="#mailInfo"role="tab" data-toggle="tab">Adres E-mail</a></li>
  </ul>

  <hr>

  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="idInfo">
      <div class="<?php echo ($profile_error === "Dane zapisano") ? 'sent' : 'error-block'; ?>">
        <?php echo $profile_error; ?>
      </div>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="upload-user_avatar">
            Avatar Użytkownika
            <div class="profile-user_thumbnail"><img class="user_thumbnail img-responsive" src="../img/uploads/<?php echo $_SESSION['thumb']; ?>"></div>
          </label>
          <input id="upload-user_avatar" type="file" name="avatar">
        </div>
        <button class="btn btn-primary" value="idInfo" type="submit" name="send_form">Zmień Dane</button>
      </form>
    </div>
    <div role="tabpanel" class="tab-pane" id="loginInfo">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group">
          <label for="upload-username">Nazwa Użytkownika</label>
          <input id="upload-username" type="text" value="<?php echo $_SESSION['username']; ?>" name="login_user" class="form-control">
        </div>
        <button class="btn btn-primary" type="submit" value="loginInfo" name="send_form">Zmień Dane</button>
        <hr>
        <button class="btn btn-block btn-danger" type="submit" value="change_pass" name="send_form">Zmień hasło</button>
      </form>
    </div>
    <div role="tabpanel" class="tab-pane" id="addInfo">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group">
          <label for="upload-firstname">Imię</label>
          <input id="upload-firstname" class="form-control" value="<?php echo $data['first_name']; ?>" name="first-name" type="text">
        </div>
        <div class="form-group">
          <label for="upload-lastname">Nazwisko</label>
          <input id="upload-lastname" class="form-control" name="last-name" value="<?php echo $data['last_name']; ?>" type="text">
        </div>
        <button class="btn btn-primary" type="submit" value="addInfo" name="send_form">Zmień Dane</button>
      </form>
    </div>
    <div role="tabpanel" class="tab-pane" id="mailInfo">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group">
          <label for="upload-email">E-mail</label>
          <input id="upload-email" value="<?php echo $data['email']; ?>" class="form-control" type="text">
        </div>
        <button class="btn btn-primary" type="submit" value="mailInfo" name="send_form">Zmień Dane</button>
      </form>
    </div>
  </div>
</div>
