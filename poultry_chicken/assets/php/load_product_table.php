<?php
include ("config.php");
session_start();
?>
<thead>
    <tr>
        <td>ID</td>
        <td>Type</td>
        <td>Description</td>
        <td>Price</td>
        <td>Action</td>
    </tr>
</thead>
<tbody>
    <?php
    $user = $_SESSION["Username"];
    $sql = "SELECT * FROM `tbl_products` WHERE P_Seller = '$user'";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td>
                    <?= $row['P_ID']; ?>
                </td>
                <td>
                    <?= $row['P_Type']; ?>
                </td>
                <td>
                    <?= $row['P_Description']; ?>
                </td>
                <td>
                    <?= $row['P_Price']; ?>
                </td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="deleteProduct(<?= $row['P_ID']; ?>);">DELETE</button>
                </td>
            </tr>
            <?php
        }
    }
    ?>
</tbody>
<?php
?>