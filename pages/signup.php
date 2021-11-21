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
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="navbar">
        <div class="nav-logo">
            <h2>YSM LIBRARY</h2>
        </div>
        <div class="nav-btns">
            <a href="./admin.php" class="btn btn-sm">HOME</a>
            <a href="./logout.php" class="btn btn-sm">LOG OUT</a>
            <a href="" class="btn btn-sm sec"><?php session_start(); echo $_SESSION['username'] ?></a>
        </div>
    </div>
    <div class="main">
        <form class="container md-col w-700" action="./signup.php" method="POST">
            <div class="row">
                <div class="col">
                    <label class="lb-lg for="userid">USER ID</label>
                </div>
                <div class="col">
                    <input class="lb-lg type="text" placeholder="User ID" name="uid" id="uid" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="lb-lg for="email">EMAIL ADDRESS</label>
                </div>
                <div class="col">
                <input class="lb-lg type="text" placeholder="Email Address" name="email" id="email" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="lb-lg for="fname">FIRST NAME</label>
                </div>
                <div class="col">
                <input class="lb-lg type="text" placeholder="First Name" name="fname" id="fname" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="lb-lg for="lname">LAST NAME</label>
                </div>
                <div class="col">
                <input class="lb-lg type="text" placeholder="Last Name" name="lname" id="lname" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="lb-lg for="phone">PHONE</label>
                </div>
                <div class="col">
                    <input class="lb-lg type="tel" placeholder="Phone Number" name="phone" id="phone" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="lb-lg for="password">PASSWORD</label>
                </div>
                <div class="col">
                <input class="lb-lg type="password" placeholder="Password" name="pass" id="pass" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="lb-lg for="password">CONFIRM PASSWORD</label>
                </div>
                <div class="col">
                <input class="lb-lg type="password" placeholder="Confirm Password" name="cpass" id="cpass" required>
                </div>
            </div>
            <div class="row row-cen">
                <button type="submit" class="btn btn-sm">REGISTER</button>
            </div>
        </form>
    </div>
</body>
</html>