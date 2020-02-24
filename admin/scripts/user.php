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