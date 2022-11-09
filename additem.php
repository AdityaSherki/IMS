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

    <?php include "header.php"; ?>
    
    <div class="container">
        <div class="pgname">
            <p>ADD ITEM</p>
        </div>

        <form class="additem" method="post" action="process.php">

            <div class="iname">
                <div class="input-name">ITEM NAME</div>
                <input type="text" name="iname" class="form-control" required>
            </div>

            <div class="icategory">
                <div class="input-name">CATEGORY</div>
                <input type="text" name="icategory" class="form-control" required>
            </div>

            <div class="iprice">
                <div class="input-name">PRICE</div>
                <input type="text" name="iprice" class="form-control" required>
            </div>

            <div class="iprice">
                <div class="input-name"><br></div>
                <button class="btn btn-success" type="submit" name="add">ADD ITEM</button>
            </div>
            
            
            </a>
        </form>
        <?php include "sidebar.php"; ?>
        <?php include "itemlist.php"; ?>

    </div>
</body>

</html>