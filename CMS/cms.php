<?php
if (session_status() != 2) {
    session_start();
}
if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Malaz</title>
        <link rel="icon" href="../Malaz Design/Malaz---icon.ico" type="image/x-icon">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.cdnfonts.com/css/tw-cen-mt-std" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="cms.css">
        <style>
            .main-div {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin: 10px;
                text-align: center;
            }
            #barChart{
                width:100%;
                max-width:700px
            }
            @media screen and (max-width:500px){
                #barChart{
                    min-height: 350px;
                }
            }
            @media screen and (max-width:450px){
                .main-div:nth-child(3){
                    display: none;
                    width: 0;
                    height: 0;
                }
                .main-div:nth-child(2){
                    height: 90vh;
                    justify-content: center;
                }
            }
        </style>
    </head>

    <body>
        <?php
        include "cms-nav.php";
        include '../config.php';
        //getting best selling items
        $topFiveTitle = array();
        $topFiveAmount = array();
        $query = "SELECT menuitem.ItemName, COUNT(menuitem.ItemName) as Count FROM menuitem inner join includes on includes.ItemNum=menuitem.ItemNum INNER JOIN orders ON orders.OrderNum=includes.OrderNum GROUP BY menuitem.ItemName Order by Count DESC";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            if (count($topFiveTitle) != 5 && count($topFiveAmount) != 5) {
                array_push($topFiveTitle, $row['ItemName']);
                array_push($topFiveAmount, $row['Count']);
            }
        }
        //getting the revenue for the month

        ?>
        <div class="main-div">
            <h1>Welcome!</h1>
            <h3>Get Started on Managing your site!</h3>
        </div>
        <div class="main-div">
            <canvas id="barChart"></canvas>
        </div>

        <?php
        include "cms-footer.php";
        ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://unpkg.com/swup@4"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>
        <script src="../main.js"></script>
        <script>
            var xValues = <?php echo json_encode($topFiveTitle); ?>;
            var yValues = <?php echo json_encode($topFiveAmount); ?>;
            var barColors = ["#CE5B68", "#CE5B68", "#CE5B68", "#CE5B68", "#CE5B68"];

            new Chart("barChart", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues,
                        label: "Number of Items",
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }

                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Menu Item'
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Amount  Sold'
                            }
                        }]
                    },
                    title: {
                        display: true,
                        text: 'Best Sellers',
                        font: {
                            size: 30
                        }
                    }
                }
            });
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: ../Home/index.php");
}
?>