
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
          ['Kategoria', 'Posty'],
          ['Boostrap', 1],
          ['React', 11],
          ['PHP', 6],
          ['Python', 5],
          ['C++', 4]
        ]);


    // Set chart options
    var options = {
          chart: {
            title: 'Kategorie Twoich Postów',
            subtitle: 'Ile i gdzie się najbardziej udzielałeś',
          }
        };


    // Instantiate and draw our chart, passing in some options.
    var chart = new google.charts.Bar(document.getElementById('chart_div'));
    chart.draw(data, google.charts.Bar.convertOptions(options));

  }
