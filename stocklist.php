<?php
include_once 'db.php';

$result = $con->query("SELECT item_name,sum(quantity) as q FROM `purchase` GROUP BY item_name;");

$count =1;
?>
<div class="tb-container">
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th>Sr No.</th>
            <th>Item name</th>
            <th>Quantity</th>
        </tr>
        </thead>
        <tbody id="data">
            <?php while ($data = $result->fetch_assoc()) : ?>

                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $data['item_name']; ?></td>
                    <td><?php echo $data['q']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>