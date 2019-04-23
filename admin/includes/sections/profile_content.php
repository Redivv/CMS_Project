<div class="container-fluid">
  <ul class="nav nav-pills nav-justified" role="tablist">
    <li role="presentation" class="active"><a href="#idInfo" aria-controls="home" role="tab" data-toggle="tab">Identyfikator Użytkownika</a></li>
    <li role="presentation"><a href="#loginInfo" aria-controls="profile" role="tab" data-toggle="tab">Dane Logowania</a></li>
    <li role="presentation"><a href="#addInfo" aria-controls="messages" role="tab" data-toggle="tab">Informacje Szczegółowe</a></li>
    <li role="presentation"><a href="#mailInfo" aria-controls="settings" role="tab" data-toggle="tab">Adres E-mail</a></li>
  </ul>

  <hr>

  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="idInfo">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="upload-user_avatar">
            Avatar Użytkownika
            <div class="profile-user_thumbnail"><img class="user_thumbnail img-responsive" src="../img/uploads/<?php echo $_SESSION['thumb']; ?>"></div>
          </label>
          <input id="upload-user_avatar" type="file">
        </div>
        <button class="btn btn-primary" type="submit" name="button">Zmień Dane</button>
      </form>
    </div>
    <div role="tabpanel" class="tab-pane" id="loginInfo">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group">
          <label for="upload-username">Nazwa Użytkownika</label>
          <input id="upload-username" type="text" class="form-control">
        </div>
        <div class="form-group">
          <label for="upload-new_password">Nowe Hasło</label>
          <input id="upload-new_password" type="password" class="form-control">
        </div>
        <div class="form-group">
          <label for="upload-confirm_password">Potwierdź Nowe Hasło</label>
          <input id="upload-confirm_password" type="password" class="form-control">
        </div>
        <button class="btn btn-primary" type="submit" name="button">Zmień Dane</button>
      </form>
    </div>
    <div role="tabpanel" class="tab-pane" id="addInfo">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group">
          <label for="upload-firstname">Imię</label>
          <input id="upload-firstname" class="form-control" type="text">
        </div>
        <div class="form-group">
          <label for="upload-lastname">Nazwisko</label>
          <input id="upload-lastname" class="form-control" type="text">
        </div>
        <button class="btn btn-primary" type="submit" name="button">Zmień Dane</button>
      </form>
    </div>
    <div role="tabpanel" class="tab-pane" id="mailInfo">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group">
          <label for="upload-email">E-mail</label>
          <input id="upload-email" class="form-control" type="text">
        </div>
        <button class="btn btn-primary" type="submit" name="button">Zmień Dane</button>
      </form>
    </div>
  </div>
</div>
