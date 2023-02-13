<?php 
include "dbconn.php";
 
if(isset($_POST['submit'])){
$fname= $_POST['fname'];
$lname= $_POST['lname'];
$email= $_POST['email'];
$gender= $_POST['sex'];
$sql = "INSERT INTO crud (id, fname, lname, email, gender) 
VALUES (Null,'$fname','$lname','$email','$gender')";

$result = mysqli_query($conn, $sql);
if($result){
    header("Location: index.php?msg=New record created successfully");
}
else {
    echo "Failed:". mysqli_error($conn);
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
</head>
<body>
    <h1 align="center">REGISTER A PLAYER</h1>
    <form method="POST">
        <table border= 0, cellpadding= 0 cellspacing=5 width= 100 height= 80 align= "center">
            <tr>
                <td>First Name:</td>
                <td><input type="text" name="fname" required></td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td><input type="text" name="lname" required></td>
            </tr>
            <tr>
                <td>email:</td>
                <td><input type="email" name="email" required></td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td><input type="radio" name="sex" value= "male" required>MALE</td>
                <td><input type="radio" name="sex" value= "female" required>FEMALE</td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="submit"></td>
            </tr>












        </table>
    </form>
</body>
</html>