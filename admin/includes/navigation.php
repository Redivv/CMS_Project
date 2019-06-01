<!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
          <!-- Mobile burger icon -->
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <!-- /.Mobile burger icon -->
          <a class="navbar-brand" href="dashboard.php">Panel Użytkownika</a>
      </div>

      <!-- Top Menu Items -->
      <ul class="nav navbar-right top-nav">

          <!-- Item HIDDEN -->
          <li class="dropdown hide">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>

              <!-- Messages -->
              <ul class="dropdown-menu message-dropdown">
                  <li class="message-preview">
                      <a href="#">
                          <div class="media">
                              <span class="pull-left">
                                  <img class="media-object" src="http://placehold.it/50x50" alt="">
                              </span>
                              <div class="media-body">
                                  <h5 class="media-heading">
                                      <strong>John Smith</strong>
                                  </h5>
                                  <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                  <p>Lorem ipsum dolor sit amet, consectetur...</p>
                              </div>
                          </div>
                      </a>
                  </li>
                  <li class="message-preview">
                      <a href="#">
                          <div class="media">
                              <span class="pull-left">
                                  <img class="media-object" src="http://placehold.it/50x50" alt="">
                              </span>
                              <div class="media-body">
                                  <h5 class="media-heading">
                                      <strong>John Smith</strong>
                                  </h5>
                                  <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                  <p>Lorem ipsum dolor sit amet, consectetur...</p>
                              </div>
                          </div>
                      </a>
                  </li>
                  <li class="message-preview">
                      <a href="#">
                          <div class="media">
                              <span class="pull-left">
                                  <img class="media-object" src="http://placehold.it/50x50" alt="">
                              </span>
                              <div class="media-body">
                                  <h5 class="media-heading">
                                      <strong>John Smith</strong>
                                  </h5>
                                  <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                  <p>Lorem ipsum dolor sit amet, consectetur...</p>
                              </div>
                          </div>
                      </a>
                  </li>
                  <li class="message-footer">
                      <a href="#">Read All New Messages</a>
                  </li>
              </ul>
              <!-- /.Messages -->

          </li>
          <!-- /.Item -->

          <!-- Item -->
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell"></i> <b class="caret"></b>
              <span class="label label-pill label-danger count" style="border-radius:10px;">2</span>
              </a>
              <!-- Alerts -->
              <ul class="dropdown-menu alert-dropdown">
                  <li>
                      <a href="#"><span class="label label-danger">Blokada</span><p>Zostałeś Zablokowany</p></a>
                  </li>
                  <li>
                      <a href="#"><span class="label label-success">Komentarz</span><p>Nowy Komentarz</p></a>
                  </li>
                  <li>
                      <a href="#"><span class="label label-success">Komentarz</span><p>Nowa Odpowiedź</p></a>
                  </li>
                  <li class="divider"></li>
                  <li>
                      <a href="#">View All</a>
                  </li>
              </ul>
              <!-- /.Alerts -->
          </li>
          <!-- /.Item -->

          <!-- Item -->
          <ul class="nav navbar-nav">
            <li class="dropdown">
                <a style="text-align:center;" href="#" class="dropdown-toggle" data-toggle="dropdown"><img id="user_avatar" src="../img/uploads/<?php echo $_SESSION['thumb']; ?>"><?php echo ' '.$_SESSION['username']; ?><b class="caret"></b></a>
                <!-- User -->
                <ul class="dropdown-menu">
                    <li style="position:relative;">
                      <a href="dashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                      <a href="profile.php"><i class="fa fa-fw fa-edit"></i> Profil</a>
                    </li>
                    <li>
                      <a href="post_edit.php"><i class="fa fa-fw fa-plus"></i> Dodaj Post</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                      <a href="logout.php"><i class="fa fa-fw fa-power-off"></i>Wyloguj Się</a>
                    </li>
                </ul>
                <!-- /.User -->

            </li>
          </ul>
          <!-- /.Item -->

      </ul>
      <!-- /.Top menu items -->

      <!-- Sidebar -->
      <?php switch ($_SESSION['role']) {
        case 3:
          include "sidebar_admin.php";
          break;
        case 2:
          include 'sidebar_author.php';
          break;
        case 1:
          include 'sidebar_user.php';
          break;

        default:
          echo "Wystąpił Bład";
          die;
      } ?>
      <!-- /.Sidebar -->

      <!-- /.navbar-collapse -->
  </nav>
<!-- /.Navigation -->
