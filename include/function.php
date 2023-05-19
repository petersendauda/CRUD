<?php

function check_login($conn){
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $query = "SELECT * FROM login WHERE id= $id";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            return $data; 
        }
    }
    header("Location: login.php");
    die;
}


















// <?php
// include("dbconn.php");


// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $email = $_POST['email'];
//     $password = $_POST['password']; 
    

//     $sql = "SELECT * FROM staff_login WHERE email= $email";
//     $result = mysqli_query($conn, $sql);

//     if ($result) {
//         $row = mysqli_fetch_assoc($result);
//         header("Location: index.php");
// }

//     }

// ?>