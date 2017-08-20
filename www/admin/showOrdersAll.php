<?php
$allOrders = Order::loadAllOrders($conn);
?>

<table>
    <tr>
        <th>ID</th>
        <th>Owner Id</th>
        <th>Creation Date</th>
        <th>Status</th>
        <th>Products</th>
        <th>Value</th>
    </tr>
<?php
foreach ($allOrders as $order) {
    var_dump(unserialize($order->getProducts()));
    echo "
    <tr>
        <td>".$order->getId()."</td>
        <td>".$order->getOwnerId().'</td>
        <td>'.$order->getCreationDate().'</td>
        <td>'.$order->getStatus().'</td>
        <td>'.$order->getProducts().'</td>
        <td>'.$order->getTotalValue().'</td>
        <td><a href="?target=categories&action=editUser&id">Edit...</a><br><a href="?target=categories&action=deleteUser&id=">Delete...</a></td>
    </tr>';
};?>
</table>