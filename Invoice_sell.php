<?php
include "db.php";

$result2 = mysqli_query($con, "SELECT DISTINCT category FROM items;");
$result3 = mysqli_query($con, "SELECT DISTINCT item_name FROM items;");
$result4 = mysqli_query($con, "SELECT id FROM invoice_sell ORDER BY id DESC LIMIT 1;");
$data = mysqli_fetch_array($result4)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="invoice_purchase.css">
    <title>Inventory Mangement System</title>
</head>

<body onload="createTable()">
    <?php include "header.php"; ?>
    <?php include "sidebar.php"; ?>
    <!-- <div class="label">TOTAL PRICE:</div>
    <input type="text" id="total_price" class="form-control" placeholder="0" readonly> -->
    <div class="container">

        <div id="upper">
            <div class="pgname">
                <p>SELL ITEMS</p>
            </div>
            <button class="btn btn-success" id="addRow" onclick="addRow();"">ADD ITEM</button>
        </div>
        <form method="post" action="Bill.php">

            <div class="invoice_detail">

                <div class="invoice">
                    <div class="input-name">INVOICE NO.</div>
                    <input id="o_id" type="text" name="o_id" class="form-control" value="<?php echo $data['id'] + 1; ?>" readonly>
                </div>

                <div class="iname">
                    <div class="input-name">CUSTOMER NAME</div>
                    <input type="text" name="s-customer" class="form-control" required>
                </div>

                <div class="iname">
                    <div class="input-name">MOBILE NO</div>
                    <input type="text" name="s-mob" class="form-control">
                </div>

                <div class="iname">
                    <div class="input-name">BILL DATE</div>
                    <input type="date" name="s-bdate" value="<?php echo date('Y-m-d')?>" class="form-control">
                </div>

            </div>

            <div class="invoice_detail">


                <div class="iname">
                    <div class="input-name">ITEM NAME</div>
                    <select id="pro_name" class="form-control" onchange="GetDetail(this.value)">
                        <option value="none">Select</option>
                        <?php
                        if (mysqli_num_rows($result3) > 0) {
                            while ($data = mysqli_fetch_array($result3)) {

                                echo '<option>' . $data['item_name'] . '</option>';
                            }
                        } ?>
                    </select>
                </div>

                <div class="icategory">
                    <div class="input-name">CATEGORY</div>
                    <select id="pro_category" class="form-control">
                        <option value="none">Select</option>
                        <?php
                        if (mysqli_num_rows($result2) > 0) {
                            while ($data = mysqli_fetch_array($result2)) {
                        ?>

                                <option><?php echo $data['category']; ?></option>
                        <?php
                            }
                        } ?>
                    </select>
                </div>

                <div class="iquantity">
                    <div class="input-name">QUANTITY</div>
                    <input name="quan" id="quan" type="number" class="form-control">
                </div>

                <div class="iprice">
                    <div class="input-name">PRICE</div>
                    <input name="pri" id="pri" type="number" class="form-control" >
                </div>


            </div>

            <div id="addcon">



            </div>
            
            
                <button class=" btn btn-secondary" type="submit" name="sell" onclick="message();">CONFIRM</button>

           


        </form>
        

    </div>

</body>

<script src="table.js">

</script>

</body>

</html>