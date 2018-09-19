<?php
//require_once 'db_connect.php';

session_start();

if(isset($_SESSION['userId'])) {
    header('location: http://localhost/sales-management-php/dashboard.php');
}

$errors = array();

if($_POST) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)) {
        if($username == "") {
            $errors[] = "Username is required";
        }

        if($password == "") {
            $errors[] = "Password is required";
        }
    } else {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $connect->query($sql);

        if($result->num_rows == 1) {
            $password = md5($password);
            // exists
            $mainSql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $mainResult = $connect->query($mainSql);

            if($mainResult->num_rows == 1) {
                $value = $mainResult->fetch_assoc();
                $user_id = $value['user_id'];

                // set session
                $_SESSION['userId'] = $user_id;

                header('location: http://localhost/sales-management-php/dashboard.php');
            } else{

                $errors[] = "Incorrect username or password";
            }
        } else {
            $errors[] = "Username does't exists";
        }
    }
}

$connect->close();
