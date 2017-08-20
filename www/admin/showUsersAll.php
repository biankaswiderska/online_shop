<?php
$allUsers = User::loadAllUsers($conn);
?>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
<?php
foreach ($allUsers as $user) {
    echo "
    <tr>
        <td>".$user->getId()."</td>
        <td>".$user->getName()."</td>
        <td>".$user->getSurname().'</td>
        <td><a href="?target=categories&action=sendEmail&id='.$user->getId().'">'.$user->getEmail().'</a></td>
        <td><a href="?target=categories&action=editUser&id='.$user->getId().'">Edit...</a><br><a href="?target=categories&action=deleteUser&id='.$user->getId().'">Delete...</a></td>
    </tr>';
};?>
</table>