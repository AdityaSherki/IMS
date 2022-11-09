<?php
include "db.php";
session_start();

$_SESSION['id'] = $_POST['o_id'];
$_SESSION['name'] = $_POST['s-customer'];
$_SESSION['phn'] = $_POST['s-mob'];
$_SESSION['date'] = $_POST['s-bdate'];

$id = $_POST['o_id'];

if (isset($_POST['sell'])) {

    $cname = mysqli_escape_string($con, $_POST['s-customer']);
    $mob = mysqli_escape_string($con, $_POST['s-mob']);
    $bdate = mysqli_escape_string($con, $_POST['s-bdate']);

    $sql = "INSERT INTO invoice_sell (customer_name,mob,bdate) VALUES ('$cname','$mob','$bdate')";
    mysqli_query($con, $sql);
    $invoiceId = mysqli_insert_id($con);

    for ($a = 0; $a < count($_POST["s-iname"]); $a++) {
        $sql = "INSERT INTO sell (order_id,item_name,category,quantity,price) VALUES ('$invoiceId', '" . $_POST['s-iname'][$a] . "', '" . $_POST['s-category'][$a] . "','" . $_POST['s-quantity'][$a] . "','" . $_POST['s-price'][$a] . "')";

        mysqli_query($con, $sql);
    }
    // header("Location: /dbmsproject/Invoice_sell.php");
    // exit;
}


$result4 = mysqli_query($con, "SELECT sum(price*quantity) as c FROM sell WHERE order_id=$id");
$data = mysqli_fetch_array($result4)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="additem.css">
    <link rel="stylesheet" href="styles.css">


    <title>Inventory Mangement System</title>
</head>

<body>

    <?php include "header.php"; ?>
    <div class="container">
        <div class="pgname">
            <p>BILL</p>
        </div>
        <div class="info">
            <table class="table">
                <tbody>
                    <tr>
                        <th>INVOICE NO</th>
                        <th>CUSTOMER NAME:</th>
                        <th>MOBILE NO:</th>
                        <th>DATE:</th>
                    </tr>
                    <tr>
                    <td><?php echo $_SESSION['id']; ?></td>
                    <td><?php echo $_SESSION['name']; ?></td>
                    <td><?php echo $_SESSION['phn']; ?></td>
                    <td><?php echo $_SESSION['date']; ?></td></tr>
            </table>
        </div>
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th>ITEM NAME</th>
                    <th>QUANTITY</th>
                    <th>PRICE RS/-(per quantity)</th>
                </tr>
                <?php for ($a = 0; $a < count($_POST["s-iname"]); $a++) : ?>
                    <tr>

                        <td><?php
                            echo $_POST['s-iname'][$a];
                            ?></td>
                        <td><?php
                            echo $_POST['s-quantity'][$a];
                            ?></td>
                        <td><?php
                            echo $_POST['s-price'][$a];
                            ?></td>

                    </tr>
                <?php endfor; ?>
                <tr colspan="2">
                    <td></td>
                    <td>TOTAL PRICE</td>
                    <td><strong><?php echo $data['c']; ?></strong></td>
                </tr>
            </tbody>
            <tr colspan="3">
                <td>
                <td></td>
                </td>
                <td><a href="index.php" class="btn btn-success">OK</a></td>
            </tr>

        </table>
    </div>
    <?php include "sidebar.php"; ?>
</body>

</html>