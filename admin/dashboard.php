<?php include 'includes/db_conn.php'; ?>
<?php include 'processing/verification.php'; verification(1); ?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <?php include "includes/header_html.php"; ?>
</head>

<body>

    <div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>
    <!-- /.Navigation -->

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Header -->
                <?php include 'includes/header.php'; create_header('Dashboard', 'podtytuł'); ?>
                <!-- /.Header -->

                <!-- Content -->
                <?php include "includes/sections/dashboard_content.php"; ?>
                <!-- /.Content -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /.page-wrapper -->

    </div>
    <!-- /.wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Google Charts -->
    <script src="js/google_charts/google_chart.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/google_charts/dashboard_chart.js"></script>

</body>

</html>
