<?php 
include "dbconn.php";
$id = $_GET['id']; 

if(isset($_POST['submit'])){
$fname= $_POST['fname'];
$lname= $_POST['lname'];
$email= $_POST['email'];
$gender= $_POST['sex'];

$sql = "UPDATE crud SET fname='$fname',lname='$lname',email='$email',gender='$gender'
 WHERE id=$id";

$result = mysqli_query($conn, $sql);

if($result) {

    header("Location: index.php?msg=Data Updated Successfully");
}
else {
    echo "Failed: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE</title>
</head>
<body>
    <h1 align="center" fontweight="bold">UPDATE A PLAYER'S INFORMATION</h1>


    <?php
    $sql = "SELECT * FROM crud where id= $id LIMIT 1"; 
    $result= mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>


    <form method="POST">
        <table border= 0, cellpadding= 0 cellspacing=5 width= 100 height= 80 align= "center">
            <tr>
                <td>First Name:</td>
                <td><input type="text" name="fname" value= "<?php echo $row['fname'] ?>" required></td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td><input type="text" name="lname" value= "<?php echo $row['lname'] ?>" value= "<?php echo $row['lname'] ?>" required></td>
            </tr>
            <tr>
                <td>email:</td>
                <td><input type="email" name="email" value= "<?php echo $row['email'] ?>" required></td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td><input type="radio" name="sex" value= "male" <?php echo ($row['gender']=='male')? "checked":""; ?> required>MALE</td>
                <td><input type="radio" name="sex" value= "female" <?php echo ($row['gender']=='female')? "checked":""; ?> required>FEMALE</td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="UPDATE"></td>
            </tr>
        </table>
    </form>


</body>
</html>