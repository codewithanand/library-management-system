<?php
    include "../partials/dbConnect.php";

    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $userID = $_POST['uid'];
        $pass = $_POST['pass'];
        
        $sql = "SELECT * FROM user_data WHERE uid = '$userID'";
        $result = mysqli_query($conn, $sql);
        $numOfRows = mysqli_num_rows($result);
        
        if($numOfRows == 1){
            while($row = mysqli_fetch_assoc($result)){
                if(password_verify($pass, $row['password'])){
                    session_start();
                    $_SESSION['username'] = $userID;
                    $_SESSION['loggedin'] = true;
                    header('location: ./admin.php');
                }
                else{
                    echo 'Error! Incorrect password';
                }
            }
        }else{
            echo 'Error! User name does not exist';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in | YSM Library</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="navbar">
        <div class="nav-logo">
            <h2>YSM LIBRARY</h2>
        </div>
        <div class="nav-btns">
            <a href="../index.php" class="btn btn-sm">HOME</a>
            <!-- <a href="./logout.php" class="btn">LOG OUT</a>
            <a href="" class="btn sec">admin</a> -->
        </div>
    </div>
    <div class="main">
        <form class="container md-col w-500" action="./signin.php" method="POST">
            <div class="row">
                <div class="col">
                    <label class="lb-lg"  for="userid">USER ID</label>
                </div>
                <div class="col">
                <input class="lb-lg"  type="text" placeholder="User ID" name="uid" id="uid" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="lb-lg"  for="pass">PASSWORD</label>
                </div>
                <div class="col">
                <input class="lb-lg"  type="password" placeholder="Password" name="pass" id="pass" required>
                </div>
            </div>
            <div class="row row-cen">
                <button type="submit" class="btn btn-sm">LOG IN</button>
            </div>
        </form>
    </div>
</body>
</html>