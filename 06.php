<?php
	date_default_timezone_set("Asia/Seoul");
	include "db.inc.php";
    include "register_globals.php";
	$conn = connectDB();
	register_globals();
    
?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>코로나 데이터 시각화</title>
    <meta name="viewport"
        content="width=device-width, maximum-scale=3.0, user-scalable=yes">
    <link href="style.css" rel="stylesheet" type="text/css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h1>정나린- 코로나 데이터 시각화 실습</h1>
    <div class="container">
    
    
      
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['sankey']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'From');
        data.addColumn('string', 'To');
        data.addColumn('number', 'Weight');
        data.addRows([
            <?php
           
            $sql = "select * from covid";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_array($result);

            while($data)
            {               
                // [ '소스', '타겟', 1],
                $src = $data["source"];
                $tgt = $data["target"];
                
                echo "[ '$src', '$tgt', 2] ,";
                $data = mysqli_fetch_array($result);

            }
        ?>
        ]);

        

 

        var colors = ['#a6cee3', '#b2df8a', '#fb9a99', '#fdbf6f',
                  '#cab2d6', '#ffff99', '#1f78b4', '#33a02c'];

        var options = {
        height: 4000,
        // sankeya: {
        //     node: {
        //     colors: colors
        //     },
        //     link: {
        //     colorMode: 'gradient',
        //     colors: colors
        //     }
        // }
        };

        // Instantiates and draws our chart, passing in some options.
        var chart = new google.visualization.Sankey(document.getElementById('sankey_basic'));
        chart.draw(data, options);
      }
    </script>

    <div class="row rowLine">
        <div class="col">
            <div id="sankey_basic" style="width: 900px; height: 4000px;"></div>            
        </div>
    </div>


    
    </div>  <!-- container -->
</body>
</html>

<?php
    closeDB($conn);
?>