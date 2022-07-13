<?php
header('Access-Control-Allow-Origin: *'); 
ob_start();
include '../backend/init.php'; 
?>

<?php

$errors = array(
    'status'=> null,
    'name' => '',
    'email' => '',
    'password' => ''
);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    function input($data){
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = stripslashes($data); 
        return $data;
    }
    $body = @file_get_contents("php://input");
    
    $reqBody = json_decode($body, true);

    $email = input($reqBody['email']);
    $password = input($reqBody['password']);

    

    $sql = "SELECT * FROM `user` WHERE `email` = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                // checking error for phone or phone number
                if($row['email'] != $email){
                    $errors['email'] = "Email Address is not registered"; 
                    $errors['status'] = false;
                }
                // checking error for password
                if($row['email'] == $email && $row['password'] != $password){
                    $errors['password'] = "Password incorrect";
                    $errors['status'] = false;
                }
                if($row['email'] == $email && $row['password'] == $password){
                    setcookie('id',$row['id'],time() + 86400 * 30,'/');
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $row['password'];
                    $errors['status'] = true;
                    
                }
            }
    }
    else{
        $errors['status'] = false;
        $errors['email'] = "Login Credientials Invalid";
    }
    echo json_encode($errors);
}


?>