<?php

require_once '../load.php';

confirm_logged_in();

$current_user = $_SESSION['user_id'];

    $getUsers = getAllUsers($current_user);

    // if(!$getUsers){
    //     $message = 'failed to get users...';
    // }

    if(isset($_GET['id'])){ // grabbed id from url
        $user_id = $_GET['id'];
        $delete_user = deleteUser($user_id);

        if(!$delete_result){
            return 'failed to delete user';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
</head>
<body>
<h1>delete user</h1>
 

<table>
            <tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>Delete User</th>
            </tr>
        <?php while ($row = $getUsers->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['user_fname']; ?></td>
            <td><?php echo $row['user_name']; ?></td>
            <td><?php echo $row['user_email']; ?></td>
            <td><a href="admin_deleteuser.php?id=<?php echo $row['user_id']; ?> ">Delete</a></td>
            </tr>
        <?php endwhile;?>
</table>

    
</body>
</html>