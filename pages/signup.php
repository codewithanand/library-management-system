<?php
        include "../partials/dbConnect.php";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['uid'];
        $email = $_POST['email'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];

        $exists = "SELECT * FROM user_data WHERE uid='$id'";
        $result = mysqli_query($conn, $exists);
        $numExistsRows = mysqli_num_rows($result);

        if($numExistsRows > 0){
            echo 'Error! user already exists';
        }
        else{
            if($pass == $cpass){
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `user_data` (`uid`,`email`,`fname`,`lname`,`phone`,`password`) VALUES ('$id', '$email', '$fname', '$lname', '$phone', '$hash')";
                $result = mysqli_query($conn, $sql);

                if($result){
                    echo 'Success! Now you can log in';
                }
                else{
                    echo 'Error! Fill the credentials very carefully '.mysqli_error($conn);
                }
            }
            else{
                echo 'Error! passwords must be same';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up | YSM Library</title>
</head>
<body>
    <div class="container">
        <form action="./signup.php" method="POST">
            <input type="text" placeholder="User ID" name="uid" id="uid">
            <input type="text" placeholder="Email Address" name="email" id="email">
            <input type="text" placeholder="First Name" name="fname" id="fname">
            <input type="text" placeholder="Last Name" name="lname" id="lname">
            <input type="tel" placeholder="Phone Number" name="phone" id="phone">
            <input type="password" placeholder="Password" name="pass" id="pass">
            <input type="password" placeholder="Confirm Password" name="cpass" id="cpass">
            <button class="btn" type="submit">Sign up</button>
        </form>
    </div>
</body>
</html>