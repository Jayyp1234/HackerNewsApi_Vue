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

    $fullname = input($reqBody['name']);
    $email = input($reqBody['email']);
    $password = input($reqBody['password']);

    #Condition 1
    $sql = "SELECT * FROM `user` WHERE `email` = '$email'";
    $result = $conn->query($sql);
    if(mysqli_num_rows($result) > 0){
        $errors['status'] = false;
        $errors['email'] = 'An account already exists using this number';
    }

    else{
        if($fullname && $email && $password){
            $sql = "INSERT INTO `user`(`id`, `name`, `email`, `password`) VALUES ('','$fullname','$email','$password')";
            
            $result = $conn->query($sql);
            if(!$result){
                $errors['status'] = false;
            }else{
                $errors['status'] = true;
            }
        }    
    }
    echo json_encode($errors);
}

?>