<?php function create_header(string $title, string $sub) : void{ ?>
  <div class="header row">
      <div class="col-lg-12">
          <h1 class="page-header">
              <?php echo $title; ?>
              <small><?php echo $sub; ?></small>
          </h1>
      </div>
  </div>
<?php } ?>
