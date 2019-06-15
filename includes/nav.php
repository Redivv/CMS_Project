<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <div class="row">

      <!-- Navigation col -->
      <div class="col-lg-10 col-md-8 left">
        <!-- Brand and toggle get grouped for better mobile display -->

        <div class="navbar-header">

          <!-- Przycisk do rozwijania nawigacji -->
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <!-- /.Przycisk do rozwijania nawigacji -->

            <!-- Link do strony / logo -->
            <a class="navbar-brand" href="index.php">Web Deweloper - Blog</a>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <?php
               $query = "SELECT * FROM categories LIMIT 5";
               $result_categories = mysqli_query($link,$query);
               while ($row = mysqli_fetch_assoc($result_categories)) {
                 $cat_title = $row['title'];
                 $cat_id = $row['id'];

                 echo "<li><a href='category.php?category=$cat_id'>$cat_title</a></li>";
               }

              ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->

    </div>
    <!-- /.Nawigation Col -->
    <div class="col-lg-2 col-md-4 right">
      
      <!-- Item -->
      <ul class="nav navbar-nav">

        <!-- Item -->
        <li style="margin-top:2.5%" class="dropdown" id="notification_dropdown">
            <a href="#" style="text-align:center" class="dropdown-toggle" id="notification_dropdown_link" data-toggle="dropdown">
            <i class="fa fa-bell"></i> <b class="caret"></b>
            <span class="label label-pill label-danger count" style="border-radius:10px;">1</span>
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
                <a style="text-align:center;" href="#" class="dropdown-toggle" data-toggle="dropdown"><img id="user_avatar" src="img/uploads/<?php echo $_SESSION['thumb']; ?>"><?php echo ' '.$_SESSION['username']; ?><b class="caret"></b></a>
                <!-- User -->
                <ul class="dropdown-menu">
                    <li style="position:relative;">
                      <a href="admin/dashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                      <a href="admin/profile.php"><i class="fa fa-fw fa-edit"></i> Profil</a>
                    </li>
                    <li>
                      <a href="admin/post_edit.php"><i class="fa fa-fw fa-plus"></i> Dodaj Post</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                      <a href="admin/logout.php"><i class="fa fa-fw fa-power-off"></i>Wyloguj Się</a>
                    </li>
                </ul>
                <!-- /.User -->
            </li>
          <?php
        }else{ ?>
          <li><a href="admin">Zaloguj Się</a></li>
          <?php } ?>
      </ul>
      <!-- /.Item -->
    </div>
  </div>
</nav>
