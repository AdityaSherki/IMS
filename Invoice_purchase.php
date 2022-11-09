<?php
include "db.php";

$result2 = mysqli_query($con, "SELECT DISTINCT category FROM items;");
$result3 = mysqli_query($con, "SELECT DISTINCT item_name FROM items;");
$result4 = mysqli_query($con, "SELECT id FROM invoice_purchase ORDER BY id DESC LIMIT 1;");
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

<body>
    <?php include "header.php"; ?>
    <?php include "sidebar.php"; ?>
    <div class="container">
        <div class="pgname">
            <p>PURCHASE</p>
        </div>
        <form method="post" action="process.php">

            <div class="invoice_detail">

                <div class="invoice">
                    <div class="input-name">INVOICE NO.</div>
                    <input id="o_id" type="text" name="o_id" class="form-control" value="<?php echo $data['id'] + 1; ?>" readonly>
                </div>

                <div class="iname">
                    <div class="input-name">SUPPLIER NAME</div>
                    <input type="text" name="p-supplier" class="form-control" required>
                </div>

                <div class="iname">
                    <div class="input-name">MOBILE NO</div>
                    <input type="text" name="p-mob" class="form-control" required>
                </div>

                <div class="iname">
                    <div class="input-name">BILL DATE</div>
                    <input type="date" name="p-bdate" class="form-control" value="<?php echo date('Y-m-d')?>" required>
                </div>

                <div class="btn-add">
                    <div class="input-name"> <br> </div>
                    <button id="add_item" type="button" class=" btn btn-success" name="add_item" onclick="addTable()">ADD ITEM</button>
                </div>

            </div>



            <div class="addcon">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>ITEM NAME</th>
                            <th>CATEGORY</th>
                            <th>QUANTITY</th>
                            <th>CARRY PRICE</th>
                            <th>PRICE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                    <tr>
                        <th colspan="4"></th>
                        <th >TOTAL PRICE</th>
                        <th><input type="text" id="total_price" class="form-control" value="0" readonly></th>
                    </tr>
                </table>




            </div>


            <div class="iname">
                <div class="input-name"><br></div>
                <button class=" btn btn-secondary" type="submit" name="purchase">CONFIRM</button>
            </div>


        </form>
        <!-- <div class="iname">
            <div class="input-name">TOTAL PRICE</div>
            
        </div> -->


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var items = 0;

        function addTable() {
            items++;

            var html = "<tr>";
            html += "<td>" + items + "</td>";
            html += `<td><select name="p-iname[]" class="form-control" id="item-name"  required>` +
                `<option>SELECT</option>` +
                `<?php while ($data = mysqli_fetch_array($result3)) : ?>` +
                `<option>` + `<?php echo $data['item_name']; ?>` + `</option>` +
                +`<?php endwhile; ?>` +
                `</select></td>`;
            html += `<td><select name="p-category[]" class="form-control" id="category" required>` +
                `<option>SELECT</option>` +
                `<?php while ($data1 = mysqli_fetch_array($result2)) : ?>` +
                `<option>` + `<?php echo $data1['category']; ?>` + `</option>` +
                +`<?php endwhile; ?>` +
                `</select></td>`;

            html += `<td><input id="quan" type="number" name="p-quantity[]" class="form-control"  value="" required></td>`;
            html += `<td> <input id="car" type="number" name="p-carry[]"  class="form-control" required></td>`;
            html += `<td><input id="pri" type="number" name="p-price[]" class="form-control" oninput='add();' required></td>`;
            html += `<td><button type='button' class="btn btn-danger" onclick='deleteRow(this);'>Delete</button></td>`;
            html += "</tr>";

            var row = document.getElementById("tbody").insertRow();
            row.innerHTML = html;
        }


        function add() {

            var a = document.getElementsByName("p-price[]");
            var b = document.getElementsByName("p-carry[]");
            var q = document.getElementsByName("p-quantity[]");
            var sum = 0;

            for (let i = 0; i < a.length; i++) {
                sum += (parseInt(a[i].value) * parseInt(q[i].value)) + parseInt(b[i].value);
            }
            // console.log(a[1].value);
            // console.log(b[0].value);
            // console.log(q[0].value);
            document.getElementById("total_price").value = sum;
            console.log(sum);
            // var first_number = parseFloat(a.value);
            // if (isNaN(first_number)) first_number = 0;
            // var second_number = parseFloat(b.value);
            // if (isNaN(second_number)) second_number = 0;
            // var multiplying_factor = parseFloat(q.value);
            // // alert(multiplying_factor);
            // var sub_res = first_number * multiplying_factor;
            // var result = sub_res + second_number;
            // if (!isNaN(result)) {
            //     document.getElementById("total_price").value = result;
            // } else {
            //     document.getElementById("total_price").value = 0;
            // }
        }

        function deleteRow(button) {
            items--
            button.parentElement.parentElement.remove();
            // first parentElement will be td and second will be tr.
        }
    </script>

</body>

</html>