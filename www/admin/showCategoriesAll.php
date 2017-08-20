<?php
$allCategories = Category::loadAllCategories($conn);
?>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
<?php
foreach ($allCategories as $category) {
    echo "
    <tr>
        <td>".$category->getId()."</td>
        <td>".$category->getName()."</td>
        <td>".$category->getDescription().'</td>
        <td><a href="?target=categories&action=editCategory&id='.$category->getId().'">Edit...</a><br><a href="?target=categories&action=deleteCategory&id='.$category->getId().'">Delete...</a></td>
    </tr>';
};?>
</table>