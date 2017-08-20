<?php
$allProducts = Product::loadAllProducts($conn);
?>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>
<?php
foreach ($allProducts as $product) {
    echo "
    <tr>
        <td>".$product->getId()."</td>
        <td>".$product->getName()."</td>
        <td>".$product->getDescription()."</td>
        <td>".$product->getPrice().'</td>
        <td><a href="?target=products&action=editProduct&id='.$product->getId().'">Edit...</a><br><a href="?target=products&action=deleteProduct&id='.$product->getId().'">Delete...</a></td>
    </tr>';
};?>
</table>
