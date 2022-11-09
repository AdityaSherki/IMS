<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="additem.css">

    <title>Inventory Mangement System</title>
</head>

<body>
    <?php include "db.php"; ?>
    <?php include "header.php"; ?>
    <?php include "sidebar.php"; ?>
    <div class="container">
        <div class="pgname">
            <p>UPDATE ITEM</p>
        </div>
        <?php
        if (isset($_GET['id'])) {
            $id = mysqli_escape_string($con, $_GET['id']);
            $sql = "SELECT * FROM items WHERE id ='$id';";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_array($result);
        ?>
                <form class="additem" method="post" action="process.php">

                    <input type="hidden" name="id" value="<?= $id; ?>">

                    <div class="iname">
                        <div class="input-name">ITEM NAME</div>
                        <input class="form-control" type="text" name="iname" value="<?= $data['item_name']; ?> "required>
                    </div>

                    <div class="icategory">
                        <div class="input-name">CATEGORY</div>
                        <input class="form-control" type="text" name="icategory" value="<?= $data['category']; ?> "required>
                    </div>

                    <div class="iprice">
                        <div class="input-name">PRICE</div>
                        <input class="form-control"type="text" name="iprice" value="<?= $data['price']; ?> " required>
                    </div>

                    <div class="iupdate">
                    <div class="input-name"><br></div>
                        <button class="btn btn-dark" type="submit" name="update">Update</button>
                    </div>
                    </a>
                </form>
        <?php

            } else {
                echo "<h4>No such id</h4>";
            }
        }
        ?>

    </div>
</body>

</html>