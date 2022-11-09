<?php
include_once 'db.php';

//update item
if (isset($_POST['update'])) {
  $id = mysqli_escape_string($con, $_POST['id']);
  $item_name = mysqli_escape_string($con, $_POST['iname']);
  $cat = mysqli_escape_string($con, $_POST['icategory']);
  $price = mysqli_escape_string($con, $_POST['iprice']);
  $sql = "UPDATE items SET item_name='$item_name',category='$cat',price='$price' WHERE id='$id';";
  $result = mysqli_query($con, $sql);
  if ($result == TRUE) {
    echo "<script>console.log('Record Updated Successfully');</script>";
    header("Location: /dbmsproject/additem.php");
    exit;
  } else {
    echo "<script>console.log('Error:'.$sql+'\n'+.$con->error');</script>";
  }
}
//add item 
if (isset($_POST['add'])) {
  $id = mysqli_escape_string($con, $_POST['id']);
  $item_name = mysqli_escape_string($con, $_POST['iname']);
  $cat = mysqli_escape_string($con, $_POST['icategory']);
  $price = mysqli_escape_string($con, $_POST['iprice']);
  $sql = "INSERT INTO items (id,item_name,category,price)VALUES ('$id','$item_name','$cat','$price');";

  if (mysqli_query($con, $sql)) {
    header("Location: /dbmsproject/additem.php");
    exit;
  } else {
    echo '<script>console.log("values failed to insert")</script>';
  }
}
//delete item
if (isset($_POST['delete'])) {
  $id = mysqli_escape_string($con, $_POST['delete']);
  $sql = "DELETE FROM items WHERE id='$id';";
  if (mysqli_query($con, $sql)) {
    header("Location: /dbmsproject/additem.php");
    exit;
  } else {
    echo '<script>console.log("values failed to insert")</script>';
  }
}

// if (isset($_POST['purchase'])) {
//   $order_id =mysqli_escape_string($con,$_POST['o_id']);
//   $bdate = mysqli_escape_string($con, $_POST['p-bdate']);
//   $sname = mysqli_escape_string($con, $_POST['p-supplier']);
//   $rdate = mysqli_escape_string($con, $_POST['p-rdate']);
//   $quan = mysqli_escape_string($con, $_POST['p-quantity']);
//   $price = mysqli_escape_string($con, $_POST['p-price']);
//   $car = mysqli_escape_string($con, $_POST['p-carry']);
//   $item_name = mysqli_escape_string($con, $_POST['p-iname']);
//   $cat = mysqli_escape_string($con, $_POST['p-category']);
//   $sql = "INSERT INTO purchase_item(order_id,bill_date,supplier_name,receive_date,quantity,price,carry,item_name,category)VALUES ('$order_id','$bdate','$sname','$rdate','$quan','$price','$car','$item_name','$cat');";

//   if (mysqli_query($con, $sql)) {
//     header("Location: /dbmsproject/purchase.php");
//     exit;
//   } else {
//     echo '<script>console.log("values failed to insert")</script>';
//   }

// }



if (isset($_POST["purchase"])) {

  $sname = mysqli_escape_string($con, $_POST['p-supplier']);
  $mob = mysqli_escape_string($con, $_POST['p-mob']);
  $bdate = mysqli_escape_string($con, $_POST['p-bdate']);

  $sql = "INSERT INTO invoice_purchase (supplier_name,mobile,bdate) VALUES ('$sname','$mob','$bdate')";
  mysqli_query($con, $sql);
  $invoiceId = mysqli_insert_id($con);

  for ($a = 0; $a < count($_POST["p-iname"]); $a++) {
    $sql = "INSERT INTO purchase (order_id,quantity,price,carry,item_name,category) VALUES ('$invoiceId', '" . $_POST['p-quantity'][$a] . "', '" . $_POST['p-price'][$a] . "','" . $_POST['p-carry'][$a] . "','" . $_POST['p-iname'][$a] . "','" . $_POST['p-category'][$a] . "')";
    mysqli_query($con, $sql);
  }
  header("Location: /dbmsproject/Invoice_purchase.php");
  exit;
}

// //sell_items
// if (isset($_POST['sell'])) {
//   $id = mysqli_escape_string($con, $_POST['s-id']);
//   $bdate = mysqli_escape_string($con, $_POST['s-bdate']);
//   $cname = mysqli_escape_string($con, $_POST['s-cust']);
//   $item_name = mysqli_escape_string($con, $_POST['s-iname']);
//   $cat = mysqli_escape_string($con, $_POST['s-category']);
//   $quan = mysqli_escape_string($con, $_POST['s-quantity']);
//   $price = mysqli_escape_string($con, $_POST['s-price']);
//   $sql = "INSERT INTO sell (s_id,bdate,cname,item_name,category,quantity,price)
//           VALUES ('$id','$bdate','$cname','$item_name','$cat','$quan','$price');";

//   if (mysqli_query($con, $sql)) {
//     header("Location: /dbmsproject/sellitems.php");
//     exit;
//   } else {
//     echo '<script>console.log("values failed to insert")</script>';
//   }
// }

if (isset($_REQUEST['item'])) {
  $iname = $_REQUEST['item'];

  if ($iname !== "") {


    $query = mysqli_query($con, "SELECT price FROM items WHERE item_name='$iname'");

    $row = mysqli_fetch_array($query);

    $price = $row["price"];
  }
  $result = array("$price");

  $myJSON = json_encode($result);
  echo $myJSON;
}

$Result =20001;

if (isset($_POST['sell'])) {
  global $Result;
  $cname = mysqli_escape_string($con, $_POST['s-customer']);
  $mob = mysqli_escape_string($con, $_POST['s-mob']);
  $bdate = mysqli_escape_string($con, $_POST['s-bdate']);

  $sql = "INSERT INTO invoice_sell (customer_name,mob,bdate) VALUES ('$cname','$mob','$bdate')";
  mysqli_query($con, $sql);
  $invoiceId = mysqli_insert_id($con);
  $Result = $invoiceId;

  for ($a = 0; $a < count($_POST["s-iname"]); $a++) {
    $sql = "INSERT INTO sell (order_id,item_name,category,quantity,price) VALUES ('$invoiceId', '" . $_POST['s-iname'][$a] . "', '" . $_POST['s-category'][$a] . "','" . $_POST['s-quantity'][$a] . "','" . $_POST['s-price'][$a] . "')";

    mysqli_query($con, $sql);
  }
  header("Location: /dbmsproject/Invoice_sell.php");
  exit;
}
