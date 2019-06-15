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
    <script src="js/notifications.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['bar']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
              ['Kategoria', 'Posty' ],
              <?php
                foreach ($cat_post as $k => $v) {
                  echo "['$k', $v],";
                }
              ?>
            ]);

        // Set chart options
        var options = {
              chart: {
                title: "<?php echo ($role === 3) ? 'Popularność Kategorii' : 'Kategorie Twoich Postów' ?>",
                subtitle: "<?php echo ($role === 3) ? 'Które Działy są Najbardziej Ruchliwe' : 'Ile i gdzie się najbardziej udzielałeś' ?>",
              },
            };


        // Instantiate and draw our chart, passing in some options.
        var chart = new google.charts.Bar(document.getElementById('chart_div'));
        chart.draw(data, google.charts.Bar.convertOptions(options));

      }

    </script>

</body>

</html>
