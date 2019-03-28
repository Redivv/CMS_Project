<!-- Header -->
  <?php function create_header(string $title, string $sub) : void{ ?>
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">
              <?php echo $title; ?>
              <small><?php echo $sub; ?></small>
          </h1>

          <!-- Breadcrumbs -->
          <ol class="breadcrumb">
              <li>
                  <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
              </li>
              <li class="active">
                  <i class="fa fa-file"></i> Blank Page
              </li>
          </ol>
          <!-- /.Breadcrumbs -->

      </div>
  </div>
<?php } ?>
<!-- /.Header -->
