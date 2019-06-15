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

      <div class="col-lg-2 col-lg-offset-8 col-md-offset-9 col-sm-offset-8 right">
      
      <!-- Item -->
      <ul class="nav navbar-nav">

        <!-- Item -->
        <li style="margin-top:2.5%" class="dropdown" id="notification_dropdown">
            <a href="#" style="text-align:center" class="dropdown-toggle" id="notification_dropdown_link" data-toggle="dropdown">
            <i class="fa fa-bell"></i> <b class="caret"></b>
            <span class="label label-pill label-danger count" style="border-radius:10px;"></span>
            </a>
            <!-- Alerts -->
            <ul id="notification_dropdown_menu" class="dropdown-menu alert-dropdown">
            
            </ul>
            <!-- /.Alerts -->
        </li>
        <!-- /.Item -->
        
        <?php
          session_start();
          if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){  ?>
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
          <?php
        }else{ ?>
          <li><a href="admin">Zaloguj Się</a></li>
          <?php } ?>
      </ul>

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
