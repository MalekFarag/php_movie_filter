<?php
function createuser($fname, $username, $email, $password){
    
    $pdo = Database::getInstance()->getConnection();

    //creating user sql query from form details
    $create_user_query = 'INSERT INTO tbl_user (user_fname, user_name, user_pass, user_email) VALUES (:fname, :username, :password, :email);';

    $user_signup = $pdo->prepare($create_user_query);
    $user_signup_res = $user_signup->execute(
        array(
            ':fname'=>$fname,
            ':username'=>$username,
            ':email'=>$email,
            ':password'=>$password,
        )
    );

    if($user_signup_res){
        redirect_to('index.php');
        $message = 'created user';

    }else{
        return 'user did not got through';
    }
    //if user created successfully redirect to index.php
    //need error catch****
    
    return $message;
}

function getSingleUser($id){
    $pdo = Database::getInstance()->getConnection();
    // fetch current user

    $get_user_query = "SELECT * FROM tbl_user WHERE user_id = :id";
    $get_user_set = $pdo->prepare($get_user_query);
    $get_user_res = $get_user_set->execute(
        array(
            ':id'=>$id
        )
    );

    //edit user res is a boolean value
        // used for error catching****
    if($get_user_res){
        $user = $get_user_set;
    }else{
        $user = 'error';
    }

    return $user;
}

function editUser($id, $fname, $username, $password, $email){
    $pdo = Database::getInstance()->getConnection();
    // fetch current user

    $edit_user_query = "UPDATE tbl_user SET user_fname = :fname, user_name = :username, user_pass = :password, user_email = :email WHERE user_id = :id";
    $edit_user_set = $pdo->prepare($edit_user_query);
    $edit_user_res = $edit_user_set->execute(
        array(
            ':id'=>$id,
            ':fname'=>$fname,
            ':username'=>$username,
            ':password'=>$password,
            ':email'=>$email
        )
    );

    //edit user res is a boolean value
        // used for error catching****
    if($edit_user_res){
        $message = 'user updated';
        redirect_to('index.php');
    }else{
        $message = 'error updating user';
    }

    return $message;
}

function getAllUsers($current_user){

    $pdo = Database::getInstance()->getConnection();

    $query = "SELECT * FROM tbl_user WHERE user_id != $current_user";
    $results = $pdo->query($query);

    if ($results) {
        return $results;
    } else {
        return 'There was a problem accessing this info';
    }
}

function deleteUser($user_id){
    $pdo = Database::getInstance()->getConnection();
    $query = "DELETE FROM tbl_user WHERE user_id = $user_id"; // ****prepare here (need change)*****

    $delete_user = $pdo->query($query);

    if($delete_user && $delete_user->rowCount() === 1){ //counting how many rows affected
       redirect_to('admin_deleteuser.php'); 
    }else{
        return 'there has been an error deleting the user';
    }
}