<?php
include "db.php";

$query1 = mysqli_query($con, "SELECT count(DISTINCT item_name) as c FROM items;");
$result1 = mysqli_fetch_array($query1);
$query2 = mysqli_query($con, "SELECT count(DISTINCT id) as c FROM invoice_sell;");
$result2 = mysqli_fetch_array($query2);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Inventory Mangement System</title>
</head>

<body>

    <?php include "./header.php"; ?>


    <div class="pagetitle">
        <p>&#128200; STATUS</p>
    </div>
    <div class="container-con">
        <div class="cards">
            <div class="card1">
                <div>
                    <h2 class="title">&#128092; ITEMS</h2>
                </div>
                <div class="result" ><?php echo $result1['c']; ?></div>
            </div>

            <div class="card1">
                <div>
                    <h2 class="title">&#128221;ORDERS</h2>
                </div>
                <div class="result" ><?php echo $result2['c']; ?></div>
            </div>

        </div>
    </div>

    <?php include "./sidebar.php"; ?>
</body>

</html>