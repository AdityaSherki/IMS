<?php
include_once 'db.php';

$result = $con->query("SELECT * FROM items");
$id = 1;
?>
<div class="tb-container">
    <h4>List of products</h4>
    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>SR NO.</th>
                <th>ITEM NAME</th>
                <th>CATEGORY</th>
                <th>PRICE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody id="data">
            <?php while ($data = $result->fetch_assoc()) : ?>

                <tr>
                    <td><?php echo $id;
                        $id++; ?></td>
                    <td><?php echo $data['item_name']; ?></td>
                    <td><?php echo $data['category']; ?></td>
                    <td><?php echo $data['price']; ?></td>
                    <td><a class="btn btn-secondary" href="update.php?id=<?php echo $data['id']; ?>">Update</a>
                        <form method="post" action="process.php" class="d-inline">
                            <button class="btn btn-danger" type="submit" name="delete" value="<?php echo $data['id']; ?>">Delete</button>
                        </form>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>